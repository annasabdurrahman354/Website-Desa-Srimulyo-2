<?php

namespace App\Http\Livewire\Guest\KotakSaran;

use App\Models\KotakSaran;
use Livewire\Component;

class GuestKotakSaran extends Component
{
    public KotakSaran $kotakSaran;

    public function mount(KotakSaran $kotakSaran)
    {
        $this->kotakSaran = $kotakSaran;
    }

    public function render()
    {
        return view('livewire.guest.kotak-saran.index')->extends('layouts.guest');
    }

    public function submit()
    {
        $this->validate();

        $this->kotakSaran->save();

        return redirect()->route('guest.home');
    }

    protected function rules(): array
    {
        return [
            'kotakSaran.pengirim' => [
                'string',
                'nullable',
            ],
            'kotakSaran.nomor_telepon' => [
                'string',
                'numeric',
                'nullable',
            ],
            'kotakSaran.isi' => [
                'string',
                'required',
            ],
        ];
    }
}
