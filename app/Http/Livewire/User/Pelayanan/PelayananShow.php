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

    public function nilai(){
        $this->validate();
        $this->pelayanan->save();
        redirect(route("user.pelayanan.show", $this->pelayanan));
    }

    protected function rules(): array
    {
        return [
            'pelayanan.rating' => [
                'required',
                'in:' . implode(',', array_keys($this->pelayanan::RATING_RADIO)),
            ],
            'pelayanan.penilaian_pemohon' => [
                'string',
                'nullable',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.user.pelayanan.show')->extends('layouts.user');
    }
}
