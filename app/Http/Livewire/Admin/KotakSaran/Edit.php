<?php

namespace App\Http\Livewire\Admin\KotakSaran;

use App\Models\KotakSaran;
use Livewire\Component;

class Edit extends Component
{
    public KotakSaran $kotakSaran;

    public function mount(KotakSaran $kotakSaran)
    {
        $this->kotakSaran = $kotakSaran;
    }

    public function render()
    {
        return view('livewire.admin.kotak-saran.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->kotakSaran->save();

        return redirect()->route('admin.kotak-sarans.index');
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
                'nullable',
            ],
            'kotakSaran.isi' => [
                'string',
                'required',
            ],
        ];
    }
}
