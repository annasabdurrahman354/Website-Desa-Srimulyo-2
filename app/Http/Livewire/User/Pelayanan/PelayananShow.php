<?php

namespace App\Http\Livewire\User\Pelayanan;

use App\Models\Pelayanan;
use Livewire\Component;
use Illuminate\Support\Str;

class PelayananShow extends Component
{
    public Pelayanan $pelayanan;
    public $berkasPelayananByType;
  
    public function mount(Pelayanan $pelayanan)
    {
        $this->pelayanan =  $pelayanan->load('pemohon', 'jenisLayanan');
        $this->berkasPelayananByType =  $pelayanan->berkasPelayananByType();
    }

    public function render()
    {
        return view('livewire.user.pelayanan.show')->extends('layouts.user');
    }
}
