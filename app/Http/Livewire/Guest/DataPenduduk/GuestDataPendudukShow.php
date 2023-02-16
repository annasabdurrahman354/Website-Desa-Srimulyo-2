<?php

namespace App\Http\Livewire\Guest\DataPenduduk;

use App\Models\DataPenduduk;
use Livewire\Component;

class GuestDataPendudukShow extends Component
{
    public DataPenduduk $dataPenduduk;

    public function mount($slug)
    {
        $this->dataPenduduk = DataPenduduk::where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.guest.artikel.show')->extends('layouts.guest');
    }

    public function submit()
    {

    }
}
