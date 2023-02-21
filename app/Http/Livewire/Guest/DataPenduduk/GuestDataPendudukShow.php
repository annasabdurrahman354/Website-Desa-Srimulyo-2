<?php

namespace App\Http\Livewire\Guest\DataPenduduk;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Models\ProdukHukum;
use Livewire\Component;

class GuestDataPendudukShow extends Component
{
    public $produkHukum;
    public $kategoris = [];
    public $artikels = [];
    public $query = '';

    public function mount($slug)
    {
        $this->produkHukum = ProdukHukum::where('slug', $slug)->first();
        if(!$this->produkHukum) return abort(404);
        $this->artikels = Artikel::with(['penulis', 'kategori'])->orderBy('id', 'desc')->take(3)->get();
        $this->kategoris = KategoriArtikel::inRandomOrder()->limit(6)->get();
    }

    public function render()
    {
        return view('livewire.guest.produk-hukum.show')->extends('layouts.guest');
    }

    public function search()
    {
        if($this->query != "") redirect(route('guest.artikel.index', ['search' => $this->query ]));
    }
}
