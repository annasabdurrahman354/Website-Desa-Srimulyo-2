<?php

namespace App\Http\Livewire\Admin\KategoriProduk;

use App\Models\KategoriProduk;
use Livewire\Component;

class Edit extends Component
{
    public KategoriProduk $kategoriProduk;

    public function mount(KategoriProduk $kategoriProduk)
    {
        $this->kategoriProduk = $kategoriProduk;
    }

    public function render()
    {
        return view('livewire.admin.kategori-produk.edit');
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
                'unique:kategori_produks,kategori,' . $this->kategoriProduk->id,
            ],
        ];
    }
}
