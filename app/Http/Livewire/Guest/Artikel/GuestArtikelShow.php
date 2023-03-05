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
        Artikel::where('slug', $slug)->increment('jumlah_pembaca');
        $this->artikel = Artikel::where('slug', $slug)->with(['penulis', 'kategori'])->firstOrFail();
        $this->artikels = Artikel::where('is_diterbitkan', true)->with(['penulis', 'kategori'])->orderBy('id', 'desc')->take(3)->get();
        $this->kategoris = KategoriArtikel::inRandomOrder()->limit(9)->get();
    }

    public function render()
    {
        if($this->artikel->is_diterbitkan == false) {
            $message = "Artikel tidak diterbitkan!";
            $route = route("guest.artikel.index");
            return view('livewire.guest.guest-error', compact('message', 'route'))->extends('layouts.guest');
        }
        return view('livewire.guest.artikel.show')->extends('layouts.guest');
    }

    public function search()
    {
        if($this->query != "") redirect(route('guest.artikel.index', ['search' => $this->query ]));
    }
}
