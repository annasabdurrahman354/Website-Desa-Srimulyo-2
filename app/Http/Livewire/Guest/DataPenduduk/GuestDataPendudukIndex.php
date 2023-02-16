<?php

namespace App\Http\Livewire\Guest\DataPenduduk;

use App\Models\DataPenduduk;
use Livewire\Component;

class GuestDataPendudukIndex extends Component
{
    public $dataPenduduks;

    public function mount()
    {
        $this->dataPenduduks = DataPenduduk::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.guest.artikel.index')->extends('layouts.guest');
    }

    public function submit()
    {

    }
}
