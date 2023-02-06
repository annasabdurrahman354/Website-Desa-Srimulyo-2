<?php

namespace App\Http\Livewire\Admin\SatuanProduk;

use App\Models\SatuanProduk;
use Livewire\Component;

class Create extends Component
{
    public SatuanProduk $satuanProduk;

    public function mount(SatuanProduk $satuanProduk)
    {
        $this->satuanProduk = $satuanProduk;
    }

    public function render()
    {
        return view('livewire.admin.satuan-produk.create');
    }

    public function submit()
    {
        $this->validate();

        $this->satuanProduk->save();

        return redirect()->route('admin.satuan-produks.index');
    }

    protected function rules(): array
    {
        return [
            'satuanProduk.satuan' => [
                'string',
                'required',
                'unique:satuan_produks,satuan',
            ],
        ];
    }
}
