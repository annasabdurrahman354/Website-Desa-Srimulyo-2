<?php

namespace App\Http\Livewire\SatuanProduk;

use App\Models\SatuanProduk;
use Livewire\Component;

class Edit extends Component
{
    public SatuanProduk $satuanProduk;

    public function mount(SatuanProduk $satuanProduk)
    {
        $this->satuanProduk = $satuanProduk;
    }

    public function render()
    {
        return view('livewire.satuan-produk.edit');
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
                'unique:satuan_produks,satuan,' . $this->satuanProduk->id,
            ],
        ];
    }
}
