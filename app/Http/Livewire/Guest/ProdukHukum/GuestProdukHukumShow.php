<?php

namespace App\Http\Livewire\Guest\ProdukHukum;

use App\Models\ProdukHukum;
use Livewire\Component;

class GuestProdukHukumShow extends Component
{
    public ProdukHukum $produkHukum;

    public function mount($slug)
    {
        $this->produkHukum = ProdukHukum::where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.guest.artikel.show')->extends('layouts.guest');
    }

    public function submit()
    {

    }
}
