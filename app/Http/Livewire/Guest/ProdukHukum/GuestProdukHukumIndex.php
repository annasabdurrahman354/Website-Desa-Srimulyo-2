<?php

namespace App\Http\Livewire\Guest\ProdukHukum;

use App\Models\ProdukHukum;
use Livewire\Component;

class GuestProdukHukumIndex extends Component
{
    public $produkHukums;

    public function mount()
    {
        $this->produkHukums = ProdukHukum::orderBy('created_at')->paginate(10);
    }

    public function render()
    {
        return view('livewire.guest.artikel.index')->extends('layouts.guest');
    }

    public function submit()
    {

    }
}
