<?php

namespace App\Http\Livewire\User\Pelayanan;

use App\Models\BerkasPelayanan;
use App\Models\JenisLayanan;
use App\Models\Pelayanan;
use App\Models\SyaratLayanan;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class PelayananCreate extends Component
{
    use WithFileUploads;
    
    public Pelayanan $pelayanan;
    public $jenis;
    public $syarats;

    public $inputs = [];
    public array $listsForFields = [];

    public $validatorPelayanan;
    public $validatorInputs;

    public $rulesPelayanan = [
        'pelayanan.jenis_layanan_id' => 'required|integer|exists:jenis_layanans,id',
        'pelayanan.kode' => 'required|string',
        'pelayanan.catatan_pemohon' => 'string|nullable'
    ];
    public $rulesInputs = [];

    public function rules() 
    {
        return [
            'pelayanan.catatan_pemohon' => 'string|nullable'
        ];
    }

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
        $this->pelayanan->jenis_layanan_id = $this->jenis;
        $this->validatorInputs = Validator::make($this->inputs, $this->rulesInputs);
        
        if ($this->validatorInputs->fails()) {
            
        } 
        else {
            $this->validatorPelayanan = Validator::make($this->pelayanan->toArray(), $this->rulesPelayanan);
            if ($this->validatorPelayanan->fails()) {
            
            } 
            else{
                $this->pelayanan->generateCode();
                $this->pelayanan->pemohon_id = auth()->user()->id;
                $this->pelayanan->status = "Terkirim";
                foreach ($this->syarats as $index => $syarat){
                    $berkas_pelayanan = new BerkasPelayanan();
                    $berkas_pelayanan->pelayanan_id = $this->pelayanan->id;
                    $berkas_pelayanan->syarat_layanan_id = $syarat->id;
                    $berkas_pelayanan->status = "Verifikasi";
                    if ($syarat->jenis_berkas == 'Teks') 
                    {
                        $berkas_pelayanan->teks_syarat = $this->inputs[$index];
                    } 
                    else 
                    {
                        $berkas_pelayanan->addMedia($this->inputs[$index]->getRealPath())
                                        ->usingName(Str::slug($this->pelayanan->id."-".$berkas_pelayanan->id."-".$syarat->nama, '-'))
                                        ->toMediaCollection("berkas_pelayanan_berkas_syarat");
                    } 
                    $berkas_pelayanan->save();
                }
                $this->pelayanan->save();
                return redirect()->route('user.pelayanan');
            }
        }
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['jenis_layanan'] = JenisLayanan::pluck('nama', 'id')->toArray();
    }
    
    public function updatedJenis($value)
    {
        $this->pelayanan->jenis_layanan_id = $value;
        $this->pelayanan->load('jenisLayanan.syaratLayanan')->get;
        $this->syarats = SyaratLayanan::whereHas('jenislayanan', function ($query) {
                            $query->where('jenis_layanan_id',$this->pelayanan->jenis_layanan_id);
                        })->get();
        $this->inputs = array();
        foreach ($this->syarats as $i) {
            array_push($this->inputs, "");
        }
        foreach ($this->syarats as $index => $syarat){
            if ( $syarat['jenis_berkas'] === 'Foto') 
            {
                $this->rulesInputs[$index] = 'image|mimes:jpg,png|required';
            } 
            elseif ($syarat['jenis_berkas'] === 'Dokumen') 
            {
                $this->rulesInputs[$index] = 'file|required|mimetypes:application/msword,application/pdf,application/vnd.ms-excel';
            } 
            elseif ($syarat['jenis_berkas'] === 'Teks') 
            {
                $this->rulesInputs[$index] = 'string|required';
            }
        }
    }
}
