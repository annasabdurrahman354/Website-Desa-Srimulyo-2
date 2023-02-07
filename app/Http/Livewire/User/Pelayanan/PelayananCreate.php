<?php

namespace App\Http\Livewire\User\Pelayanan;

use App\Models\BerkasPelayanan;
use App\Models\JenisLayanan;
use App\Models\Pelayanan;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class PelayananCreate extends Component
{
    public Pelayanan $pelayanan;
    public $jenis;
    public array $semuaBerkas = [];
    public array $semuaError = [];

    public array $listsForFields = [];

    public function mount(Pelayanan $pelayanan)
    {
        $this->pelayanan         = $pelayanan;
        $this->pelayanan->status = 'Terkirim';
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.user.pelayanan.create')->extends('layouts.user');
    }

    public function submit()
    {
        if(isEmpty($this->semuaError)){
            $this->validate([
                'files.*' => 'image|max:1024',
                'pelayanan.jenis_layanan_id' => 'integer|exists:jenis_layanans,id|required',
                'pelayanan.kode' => 'string|required|unique:pelayanans,kode',
                'pelayanan.catatan_pemohon' => 'string|nullable'
            ]);
            $this->pelayanan->pemohon_id = auth()->user()->id;
            $this->pelayanan->status = "Terkirim";
            $this->pelayanan->save();
    
            return redirect()->route('user.pelayanan.index');
        }
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['jenis_layanan'] = JenisLayanan::pluck('nama', 'id')->toArray();
    }
    
    public function updatedJenis($value)
    {
        $this->pelayanan->jenis_layanan_id = $value;
        $this->semuaBerkas = array();
        $this->semuaError = array();
        foreach ($this->pelayanan->jenisLayanan->syaratLayanan as $syarat) {
            $berkas_pelayanan = new BerkasPelayanan();
            $berkas_pelayanan->pelayanan_id = $this->pelayanan->id;
            $berkas_pelayanan->syarat_layanan_id = $syarat->id;
            array_push($this->semuaBerkas, $berkas_pelayanan);
        }
    }
}
