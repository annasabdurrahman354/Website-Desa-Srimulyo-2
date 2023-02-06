<?php

namespace App\Http\Livewire\Kota;

use App\Models\Kota;
use App\Models\Provinsi;
use Livewire\Component;

class Edit extends Component
{
    public Kota $kota;

    public array $listsForFields = [];

    public function mount(Kota $kota)
    {
        $this->kota = $kota;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.kota.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->kota->save();

        return redirect()->route('admin.kota.index');
    }

    protected function rules(): array
    {
        return [
            'kota.provinsi_id' => [
                'integer',
                'exists:provinsis,id',
                'required',
            ],
            'kota.nama' => [
                'string',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['provinsi'] = Provinsi::pluck('nama', 'id')->toArray();
    }
}
