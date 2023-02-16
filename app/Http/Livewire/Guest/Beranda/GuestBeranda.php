<?php

namespace App\Http\Livewire\Guest\Beranda;

use App\Models\Artikel;
use Livewire\Component;

class GuestBeranda extends Component
{
    public $latest_artikel;

    public function mount()
    {
        $this->latest_artikel = Artikel::orderBy('created_at', 'desc')->take(6)->get();
    }

    public function render()
    {
        return view('livewire.guest.home.index')->extends('layouts.guest');
    }

    public function submit()
    {

    }
}
