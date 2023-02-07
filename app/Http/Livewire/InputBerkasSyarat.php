<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class InputBerkasSyarat extends Component
{
    use WithFileUploads;

    public $berkas;
    public $file;
    public array $semuaError = [];

    public function mount($berkas, $semuaError)
    {
        $this->berkas = $berkas;
        $this->semuaError = $semuaError;
    }

    public function updateFile($file)
    {
        if($this->berkas->syaratLayanan->jenis_berkas == 'Foto'){
            $this->validateOnly('file', [
                'file' => 'image|mimes:jpg,png|required',
            ]);
            $this->file = $file;
        }
        elseif($this->berkas->syaratLayanan->jenis_berkas == 'Dokumen'){
            $this->validateOnly('file', [
                'file' => 'file|required|mimetypes:application/msword,application/pdf,application/vnd.ms-excel',
            ]);
            $this->file = $file;
        }
    }

    public function updateBerkasPelayanan($berkas)
    {

        $this->validateOnly('berkas', [
                'berkas.teks_syarat' => 'string|required',
        ]);
        $this->berkas = $berkas;
    }

    public function render()
    {
        return view('livewire.input-berkas-syarat');
    }
}
