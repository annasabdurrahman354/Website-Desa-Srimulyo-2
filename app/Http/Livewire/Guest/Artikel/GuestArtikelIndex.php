<?php

namespace App\Http\Livewire\Guest\Artikel;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Livewire\Component;
use Livewire\WithPagination;

class GuestArtikelIndex extends Component
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
            if(KategoriArtikel::where('id', $this->kategoriId)->first()){
                $this->kategoriNama        = KategoriArtikel::where('id', $this->kategoriId)->first()->kategori;
            }
        }
        if(request()->search){
            $this->search = request()->search;
        }
        $this->kategoris          = KategoriArtikel::get();
    }

    public function render()
    {
        $query = Artikel::with(['penulis', 'kategori'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => 'id',
            'order_direction' => 'desc',
        ]);
        $artikels = $query;
        if($this->kategoriId != ""){
            $artikels = $artikels->where('kategori_id', $this->kategoriId)->paginate(9);
        }
        else{
            $artikels = $query->paginate(9);
        }
        
        return view('livewire.guest.artikel.index', compact('artikels', 'query'))->extends('layouts.guest');
    }
}
