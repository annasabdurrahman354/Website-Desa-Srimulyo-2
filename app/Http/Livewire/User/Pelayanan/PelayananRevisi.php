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
    public $berkasPelayananByType = [];
    public $perlu_revisi;
    public $input;
  
    public function mount(Pelayanan $pelayanan, SyaratLayanan $syaratLayanan)
    {
        
        $this->pelayanan =  $pelayanan;
        $this->syaratLayanan = $syaratLayanan;
        $this->berkasPelayananByType = BerkasPelayanan::where('pelayanan_id', $this->pelayanan->id)
                                        ->where('syarat_layanan_id', $this->syaratLayanan->id)
                                        ->orderBy('created_at', 'DESC')
                                        ->get();
        if($this->pelayanan->hasSyaratLayanan($this->syaratLayanan->id) && $this->pelayanan->isLatestBerkasPelayananRevisi($this->syaratLayanan->id)){
            $this->perlu_revisi = true;
        }
        else{
            $this->perlu_revisi = false;
        }
    }

    public function submit()
    {
        
        $this->pelayanan->status = "Verifikasi";
        $this->pelayanan->save();
        $rules = [];
        if ( $this->syaratLayanan['jenis_berkas'] === 'Foto') 
        {
            $rules['input'] = 'image|mimes:jpg,png|required';
        } 
        elseif ($this->syaratLayanan['jenis_berkas'] === 'Dokumen') 
        {
            $rules['input'] = 'file|required|mimetypes:application/msword,application/pdf,application/vnd.ms-excel';
        } 
        elseif ($this->syaratLayanan['jenis_berkas'] === 'Teks') 
        {
            $rules['input'] = 'string|required';
        }
        
        $this->validateOnly($this->input,$rules);

        $berkas_pelayanan = new BerkasPelayanan();
        $berkas_pelayanan->pelayanan_id = $this->pelayanan->id;
        $berkas_pelayanan->syarat_layanan_id = $this->syaratLayanan->id;
        $berkas_pelayanan->status = "Verifikasi";
        $berkas_pelayanan->save();
        if ($this->syaratLayanan->jenis_berkas == 'Teks') 
        {
            $berkas_pelayanan->teks_syarat = $this->input;
        } 
        else 
        {   $file_name = Str::slug("p".$this->pelayanan->id."-m".$berkas_pelayanan->id."-".$this->syaratLayanan->nama, '-').".".pathinfo($this->input->getRealPath(), PATHINFO_EXTENSION);
            $berkas_pelayanan->addMedia($this->input->getRealPath())
                            ->usingFileName($file_name)
                            ->toMediaCollection("berkas_pelayanan_berkas_syarat");
        } 
        $berkas_pelayanan->save();
        
        return redirect()->route('user.pelayanan');
    }

    public function render()
    {
        return view('livewire.user.pelayanan.revisi')->extends('layouts.user');
    }
}
