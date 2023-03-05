<?php

namespace App\Http\Livewire\Guest\ProdukHukum;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Models\ProdukHukum;
use Livewire\Component;

class GuestProdukHukumShow extends Component
{
    public $produkHukum;
    public $kategoris = [];
    public $artikels = [];
    public $query = '';

    public function mount($slug)
    {
        $this->produkHukum = ProdukHukum::where('slug', $slug)->firstOrFail();
        $this->artikels = Artikel::where('is_diterbitkan', true)->with(['penulis', 'kategori'])->orderBy('id', 'desc')->take(3)->get();
        $this->kategoris = KategoriArtikel::inRandomOrder()->limit(6)->get();
    }

    public function render()
    {
        if($this->produkHukum->is_aktif == false) {
            $message = "Produk hukum tidak diterbitkan!";
            $route = route('guest.produk-hukum.index');
            return view('livewire.guest.guest-error', compact('message', 'route'))->extends('layouts.guest');
        }
        return view('livewire.guest.produk-hukum.show')->extends('layouts.guest');
    }

    public function search()
    {
        if($this->query != "") redirect(route('guest.artikel.index', ['search' => $this->query ]));
    }
}
