<?php

namespace App\Http\Livewire\Guest\Umkm;

use App\Models\Produk;
use App\Models\KategoriProduk;
use Livewire\Component;
use Livewire\WithPagination;

class GuestProdukIndex extends Component
{
    use WithPagination;

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

    public function mount()
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
        $this->kategoris          = KategoriProduk::get();
    }

    public function render()
    {
        $query = Produk::with(['umkm', 'satuan', 'kategori'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => 'id',
            'order_direction' => 'desc',
        ]);
        $produks = $query;
        if($this->kategoriId != ""){
            $produks = $produks->where('kategori_id', $this->kategoriId);
        }
        $produks = $produks->where('is_tampilkan', true)
                            ->whereHas('umkm', function ($query) {
                                $query->where('is_aktif', true);
                            })->paginate(9);

        return view('livewire.guest.umkm.produk-index', compact('produks', 'query'))->extends('layouts.guest');
    }
}
