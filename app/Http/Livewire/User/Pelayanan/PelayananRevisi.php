<?php

namespace App\Http\Livewire\User\Pelayanan;

use App\Models\BerkasPelayanan;
use App\Models\Pelayanan;
use App\Models\SyaratLayanan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class PelayananRevisi extends Component
{
    use WithFileUploads;

    public Pelayanan $pelayanan;
    public SyaratLayanan $syaratLayanan;
    public BerkasPelayanan $berkasPelayanan;
    public $berkasPelayananByType = [];
    public $perlu_revisi;
    public $input = "";
  
    public function mount(Pelayanan $pelayanan, SyaratLayanan $syaratLayanan)
    {
        
        $this->pelayanan =  $pelayanan;
        $this->syaratLayanan = $syaratLayanan;
        $this->berkasPelayananByType = BerkasPelayanan::where('pelayanan_id', $this->pelayanan->id)->where('syarat_layanan_id', $this->syaratLayanan->id)->get();
        if($this->pelayanan->hasSyaratLayanan($this->syaratLayanan->id) && $this->pelayanan->isLatestBerkasPelayananRevisi($this->syaratLayanan->id)){
            $this->perlu_revisi = true;
        }
        else{
            $this->perlu_revisi = false;
        }
    }

    public function render()
    {
        return view('livewire.user.pelayanan.revisi')->extends('layouts.user');
    }
}
