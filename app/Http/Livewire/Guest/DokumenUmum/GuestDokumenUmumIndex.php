<?php

namespace App\Http\Livewire\Guest\DokumenUmum;

use App\Models\DokumenUmum;
use Livewire\Component;

class GuestDokumenUmumIndex extends Component
{
    public $dokumenUmums;

    public function mount()
    {
        $this->dokumenUmums = DokumenUmum::orderBy('created_at')->paginate(10);
    }

    public function render()
    {
        return view('livewire.guest.artikel.index')->extends('layouts.guest');
    }

    public function submit()
    {

    }
}
