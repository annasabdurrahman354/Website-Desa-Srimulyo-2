<?php

namespace App\Http\Livewire\Guest\Umkm;

use App\Models\Umkm;
use App\Models\KategoriUmkm;
use Livewire\Component;
use Livewire\WithPagination;

class GuestUmkmIndex extends Component
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
            if(KategoriUmkm::where('id', $this->kategoriId)->first()){
                $this->kategoriNama        = KategoriUmkm::where('id', $this->kategoriId)->first()->kategori;
            }
        }
        if(request()->search){
            $this->search = request()->search;
        }
        $this->kategoris          = KategoriUmkm::get();
    }

    public function render()
    {
        $query = Umkm::with(['pemilik', 'kategori'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => 'id',
            'order_direction' => 'desc',
        ]);
        $umkms = $query;
        if($this->kategoriId != ""){
            $umkms = $umkms->where('kategori_id', $this->kategoriId);
        }
        
        $umkms = $umkms->where('is_aktif', true)->paginate(9);

        return view('livewire.guest.umkm.umkm-index', compact('umkms', 'query'))->extends('layouts.guest');
    }
}
