<?php

namespace App\Http\Livewire\Guest\DokumenUmum;

use App\Models\DokumenUmum;
use Livewire\Component;

class GuestDokumenUmumShow extends Component
{
    public DokumenUmum $dokumenUmum;

    public function mount($slug)
    {
        $this->dokumenUmum = DokumenUmum::where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.guest.artikel.show')->extends('layouts.guest');
    }

    public function submit()
    {

    }
}
