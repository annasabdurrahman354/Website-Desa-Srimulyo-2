<?php

namespace App\Http\Livewire\Guest\Beranda;

use App\Models\Artikel;
use App\Models\Carousel;
use App\Models\JenisLayanan;
use App\Models\KategoriArtikel;
use Livewire\Component;

class GuestBeranda extends Component
{
    public $latest_artikel = [];
    public $layanans = [];
    public string $kategoriNama = 'Semua Kategori';
    public string $kategoriId = "";
    public $kategoris = [];
    public $carousels = [];

    public function setKategori($kategoriId, $kategoriNama){
        $this->kategoriNama = $kategoriNama;
        $this->kategoriId = $kategoriId;
    }

    public function mount()
    {   
        $this->layanans = JenisLayanan::limit(10)->get();
        $this->kategoris = KategoriArtikel::get();
        $this->carousels = Carousel::where('is_aktif', 1)->get();
    }

    public function render()
    {
        if($this->kategoriId != ''){
            $this->latest_artikel = Artikel::where('kategori_id', $this->kategoriId)->where('is_diterbitkan', true)->orderBy('created_at', 'desc')->take(6)->get();
        }
        else{
            $this->latest_artikel = Artikel::where('is_diterbitkan', true)->orderBy('created_at', 'desc')->take(6)->get();
        }
        return view('livewire.guest.home.index')->extends('layouts.guest');
    }
}
