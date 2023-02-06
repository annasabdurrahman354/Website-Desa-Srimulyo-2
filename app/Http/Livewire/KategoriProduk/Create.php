<?php

namespace App\Http\Livewire\KategoriProduk;

use App\Models\KategoriProduk;
use Livewire\Component;

class Create extends Component
{
    public KategoriProduk $kategoriProduk;

    public function mount(KategoriProduk $kategoriProduk)
    {
        $this->kategoriProduk = $kategoriProduk;
    }

    public function render()
    {
        return view('livewire.kategori-produk.create');
    }

    public function submit()
    {
        $this->validate();

        $this->kategoriProduk->save();

        return redirect()->route('admin.kategori-produks.index');
    }

    protected function rules(): array
    {
        return [
            'kategoriProduk.kategori' => [
                'string',
                'required',
                'unique:kategori_produks,kategori',
            ],
        ];
    }
}
