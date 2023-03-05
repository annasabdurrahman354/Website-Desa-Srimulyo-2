<?php

namespace App\Http\Livewire\Guest\DataPenduduk;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Models\DataPenduduk;
use Livewire\Component;

class GuestDataPendudukShow extends Component
{
    public $dataPenduduk;
    public $kategoris = [];
    public $artikels = [];
    public $query = '';

    public function mount($slug)
    {
        $this->dataPenduduk = DataPenduduk::where('slug', $slug)->firstOrFail();
        $this->artikels = Artikel::where('is_diterbitkan', true)->with(['penulis', 'kategori'])->orderBy('id', 'desc')->take(3)->get();
        $this->kategoris = KategoriArtikel::inRandomOrder()->limit(6)->get();
    }

    public function render()
    {
        if($this->dataPenduduk->is_aktif == false) {
            $message = "Data penduduk tidak diterbitkan!";
            $route = route('guest.data-penduduk.index');
            return view('livewire.guest.guest-error', compact('message', 'route'))->extends('layouts.guest');
        }
        return view('livewire.guest.data-penduduk.show')->extends('layouts.guest');
    }

    public function search()
    {
        if($this->query != "") redirect(route('guest.artikel.index', ['search' => $this->query ]));
    }
}
