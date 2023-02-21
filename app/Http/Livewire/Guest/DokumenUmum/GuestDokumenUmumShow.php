<?php

namespace App\Http\Livewire\Guest\DokumenUmum;

use App\Models\Artikel;
use App\Models\DokumenUmum;
use App\Models\KategoriArtikel;
use Livewire\Component;

class GuestDokumenUmumShow extends Component
{
    public $dokumenUmum;
    public $kategoris = [];
    public $artikels = [];
    public $query = '';

    public function mount($slug)
    {
        $this->dokumenUmum = DokumenUmum::where('slug', $slug)->first();
        if(!$this->dokumenUmum) return abort(404);
        $this->artikels = Artikel::with(['penulis', 'kategori'])->orderBy('id', 'desc')->take(3)->get();
        $this->kategoris = KategoriArtikel::inRandomOrder()->limit(6)->get();
    }

    public function render()
    {
        return view('livewire.guest.dokumen-umum.show')->extends('layouts.guest');
    }

    public function search()
    {
        if($this->query != "") redirect(route('guest.artikel.index', ['search' => $this->query ]));
    }
}
