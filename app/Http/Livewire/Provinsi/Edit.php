<?php

namespace App\Http\Livewire\Provinsi;

use App\Models\Provinsi;
use Livewire\Component;

class Edit extends Component
{
    public Provinsi $provinsi;

    public function mount(Provinsi $provinsi)
    {
        $this->provinsi = $provinsi;
    }

    public function render()
    {
        return view('livewire.provinsi.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->provinsi->save();

        return redirect()->route('admin.provinsis.index');
    }

    protected function rules(): array
    {
        return [
            'provinsi.nama' => [
                'string',
                'required',
            ],
        ];
    }
}
