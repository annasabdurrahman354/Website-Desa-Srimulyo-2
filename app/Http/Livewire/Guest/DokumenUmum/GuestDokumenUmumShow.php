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
        $this->dokumenUmum = DokumenUmum::where('slug', $slug)->firstOrFail();
        $this->artikels = Artikel::where('is_diterbitkan', true)->with(['penulis', 'kategori'])->orderBy('id', 'desc')->take(3)->get();
        $this->kategoris = KategoriArtikel::inRandomOrder()->limit(6)->get();
    }

    public function render()
    {
        if($this->dokumenUmum->is_aktif == false) {
            $message = "Dokumen umum tidak diterbitkan!";
            $route = route('guest.dokumen-umum.index');
            return view('livewire.guest.guest-error', compact('message', 'route'))->extends('layouts.guest');
        }
        return view('livewire.guest.dokumen-umum.show')->extends('layouts.guest');
    }

    public function search()
    {
        if($this->query != "") redirect(route('guest.artikel.index', ['search' => $this->query ]));
    }
}
