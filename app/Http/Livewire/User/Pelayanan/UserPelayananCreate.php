<?php

namespace App\Http\Livewire\User\Pelayanan;

use App\Models\BerkasPelayanan;
use App\Models\JenisLayanan;
use App\Models\Pelayanan;
use App\Models\SyaratLayanan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class UserPelayananCreate extends Component
{
    use WithFileUploads;
    
    public Pelayanan $pelayanan;
    public $jenis;
    public $syarats;

    public $inputs = [];
    public array $listsForFields = [];

    protected $rules = [
        'pelayanan.jenis_layanan_id' => 'required|integer|exists:jenis_layanans,id',
        'pelayanan.kode' => 'required|string',
        'pelayanan.catatan_pemohon' => 'string|nullable'
    ];

    public $r = [
        'pelayanan.jenis_layanan_id' => 'required|integer|exists:jenis_layanans,id',
        'pelayanan.kode' => 'required|string',
        'pelayanan.catatan_pemohon' => 'string|nullable'
    ];

    public function mount()
    {
        $this->pelayanan         = new Pelayanan();
        $this->pelayanan->status = 'Terkirim';
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.user.pelayanan.create')->extends('layouts.user');
    }

    public function submit()
    {
        
        $this->validate();
        $this->pelayanan->jenis_layanan_id = $this->jenis;
        $this->pelayanan->pemohon_id = auth()->user()->id;
        $this->pelayanan->status = "Terkirim";
        
       

        $rules = [];
        foreach ($this->syarats as $index => $syarat){
            if ( $syarat['jenis_berkas'] === 'Foto') 
            {
                $rules['inputs.'.$index] = 'image|mimes:jpg,png|required';
            } 
            elseif ($syarat['jenis_berkas'] === 'Dokumen') 
            {
                $rules['inputs.'.$index] = 'file|required|mimetypes:application/msword,application/pdf,application/vnd.ms-excel';
            } 
            elseif ($syarat['jenis_berkas'] === 'Teks') 
            {
                $rules['inputs.'.$index] = 'string|required';
            }
        }

        $this->validate(array_merge($this->r, $rules));
        $this->pelayanan->save();
        foreach ($this->syarats as $index => $syarat){
            $berkas_pelayanan = new BerkasPelayanan();
            $berkas_pelayanan->pelayanan_id = $this->pelayanan->id;
            $berkas_pelayanan->syarat_layanan_id = $syarat->id;
            $berkas_pelayanan->status = "Verifikasi";
            $berkas_pelayanan->save();
            if ($syarat->jenis_berkas == 'Teks') 
            {
                $berkas_pelayanan->teks_syarat = $this->inputs[$index];
            } 
            else 
            {   $file_name = Str::slug("p".$this->pelayanan->id."-m".$berkas_pelayanan->id."-".$syarat->nama, '-').".".pathinfo($this->inputs[$index]->getRealPath(), PATHINFO_EXTENSION);
                $berkas_pelayanan->addMedia($this->inputs[$index]->getRealPath())
                                ->usingFileName($file_name)
                                ->toMediaCollection("berkas_pelayanan_berkas_syarat");
            } 
            $berkas_pelayanan->save();
        }
        return redirect()->route('user.pelayanan');
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['jenis_layanan'] = JenisLayanan::pluck('nama', 'id')->toArray();
    }
    
    public function updatedJenis($value)
    {
        $this->pelayanan->jenis_layanan_id = $value;
        $this->pelayanan->generateCode();

        $this->pelayanan->load('jenisLayanan.syaratLayanan')->get;
        $this->syarats = SyaratLayanan::whereHas('jenislayanan', function ($query) {
                            $query->where('jenis_layanan_id',$this->pelayanan->jenis_layanan_id);
                        })->get();
        $this->inputs = array();
        foreach ($this->syarats as $i) {
            array_push($this->inputs, "");
        }
    }
}
