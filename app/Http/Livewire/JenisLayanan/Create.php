<?php

namespace App\Http\Livewire\JenisLayanan;

use App\Models\JenisLayanan;
use App\Models\SyaratLayanan;
use Livewire\Component;

class Create extends Component
{
    public array $listsForFields = [];

    public JenisLayanan $jenisLayanan;

    public array $syarat_layanan = [];

    public function mount(JenisLayanan $jenisLayanan)
    {
        $this->jenisLayanan                   = $jenisLayanan;
        $this->jenisLayanan->biaya            = '0';
        $this->jenisLayanan->pelayanan_online = false;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.jenis-layanan.create');
    }

    public function submit()
    {
        $this->validate();

        $this->jenisLayanan->save();
        $this->jenisLayanan->syaratLayanan()->sync($this->syarat_layanan);

        return redirect()->route('admin.jenis-layanans.index');
    }

    protected function rules(): array
    {
        return [
            'jenisLayanan.nama' => [
                'string',
                'required',
                'unique:jenis_layanans,nama',
            ],
            'jenisLayanan.deskripsi' => [
                'string',
                'required',
            ],
            'jenisLayanan.biaya' => [
                'numeric',
                'required',
            ],
            'jenisLayanan.pelayanan_online' => [
                'boolean',
            ],
            'syarat_layanan' => [
                'array',
            ],
            'syarat_layanan.*.id' => [
                'integer',
                'exists:syarat_layanans,id',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['syarat_layanan'] = SyaratLayanan::pluck('nama', 'id')->toArray();
    }
}
