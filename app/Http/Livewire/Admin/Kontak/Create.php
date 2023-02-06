<?php

namespace App\Http\Livewire\Admin\Kontak;

use App\Models\Kontak;
use Livewire\Component;

class Create extends Component
{
    public Kontak $kontak;

    public array $listsForFields = [];

    public function mount(Kontak $kontak)
    {
        $this->kontak = $kontak;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.admin.kontak.create');
    }

    public function submit()
    {
        $this->validate();

        $this->kontak->save();

        return redirect()->route('admin.kontaks.index');
    }

    protected function rules(): array
    {
        return [
            'kontak.nama' => [
                'string',
                'required',
                'unique:kontaks,nama',
            ],
            'kontak.kontak' => [
                'string',
                'required',
            ],
            'kontak.jenis_kontak' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['jenis_kontak'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['jenis_kontak'] = $this->kontak::JENIS_KONTAK_SELECT;
    }
}
