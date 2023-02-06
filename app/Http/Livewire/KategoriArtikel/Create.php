<?php

namespace App\Http\Livewire\KategoriArtikel;

use App\Models\KategoriArtikel;
use Livewire\Component;

class Create extends Component
{
    public KategoriArtikel $kategoriArtikel;

    public function mount(KategoriArtikel $kategoriArtikel)
    {
        $this->kategoriArtikel = $kategoriArtikel;
    }

    public function render()
    {
        return view('livewire.kategori-artikel.create');
    }

    public function submit()
    {
        $this->validate();

        $this->kategoriArtikel->save();

        return redirect()->route('admin.kategori-artikels.index');
    }

    protected function rules(): array
    {
        return [
            'kategoriArtikel.kategori' => [
                'string',
                'required',
                'unique:kategori_artikels,kategori',
            ],
        ];
    }
}
