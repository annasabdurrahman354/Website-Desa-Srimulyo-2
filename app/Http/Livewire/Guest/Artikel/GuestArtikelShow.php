<?php

namespace App\Http\Livewire\Guest\Artikel;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Livewire\Component;

class GuestArtikelShow extends Component
{
    public $artikel;
    public $kategoris = [];
    public $artikels = [];
    public $query = '';

    public function mount($slug)
    {
        $this->artikel = Artikel::where('slug', $slug)->with(['penulis', 'kategori'])->firstOrFail();
        $this->artikels = Artikel::with(['penulis', 'kategori'])->orderBy('id', 'desc')->take(3)->get();
        $this->kategoris = KategoriArtikel::inRandomOrder()->limit(9)->get();
    }

    public function render()
    {
        return view('livewire.guest.artikel.show')->extends('layouts.guest');
    }

    public function search()
    {
        if($this->query != "") redirect(route('guest.artikel.index', ['search' => $this->query ]));
    }
}
