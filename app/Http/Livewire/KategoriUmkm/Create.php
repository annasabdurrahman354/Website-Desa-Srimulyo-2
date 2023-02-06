<?php

namespace App\Http\Livewire\KategoriUmkm;

use App\Models\KategoriUmkm;
use Livewire\Component;

class Create extends Component
{
    public KategoriUmkm $kategoriUmkm;

    public function mount(KategoriUmkm $kategoriUmkm)
    {
        $this->kategoriUmkm = $kategoriUmkm;
    }

    public function render()
    {
        return view('livewire.kategori-umkm.create');
    }

    public function submit()
    {
        $this->validate();

        $this->kategoriUmkm->save();

        return redirect()->route('admin.kategori-umkms.index');
    }

    protected function rules(): array
    {
        return [
            'kategoriUmkm.kategori' => [
                'string',
                'required',
                'unique:kategori_umkms,kategori',
            ],
        ];
    }
}
