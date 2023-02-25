<?php

namespace App\Http\Livewire\Guest\Umkm;

use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\Umkm;
use Livewire\Component;
use Livewire\WithPagination;

class GuestUmkmEtalasae extends Component
{
    use WithPagination;

    public $umkm;

    public $kategoris = [];

    public string $kategoriNama = 'Semua Kategori';

    public string $kategoriId = "";

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setKategori($kategoriId, $kategoriNama){
        $this->kategoriNama = $kategoriNama;
        $this->kategoriId = $kategoriId;
    }

    public function mount($slug)
    {
        if(request()->kategori){
            $this->kategoriId          = request()->kategori;
            if(KategoriProduk::where('id', $this->kategoriId)->first()){
                $this->kategoriNama        = KategoriProduk::where('id', $this->kategoriId)->first()->kategori;
            }
        }
        if(request()->search){
            $this->search = request()->search;
        }
        $this->umkm         = Umkm::where('slug', $slug)->firstOrFail();
        $this->kategoris    = Produk::where('umkm_id', $this->umkm->id)->with('kategori')->distinct('kategori_id')->get(['kategori_id'])->pluck('kategori.kategori')->toArray();
    }

    public function render()
    {
        $query = Produk::where('umkm_id', $this->umkm->id)->with(['satuan', 'kategori'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => 'id',
            'order_direction' => 'desc',
        ]);
        $produks = $query;
        if($this->kategoriId != ""){
            $produks = $produks->where('kategori_id', $this->kategoriId)->paginate(9);
        }
        else{
            $produks = $query->paginate(9);
        }
        return view('livewire.guest.umkm.umkm-etalase', compact('produks', 'query'))->extends('layouts.guest');
    }
}
