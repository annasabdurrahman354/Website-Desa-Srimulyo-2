<?php

namespace App\Http\Livewire\Guest\DokumenUmum;

use App\Models\DokumenUmum;
use Livewire\Component;
use Livewire\WithPagination;

class GuestDokumenUmumIndex extends Component
{
    use WithPagination;
    
    public $tahuns = [];

    public $tahun = "";

    public string $search = '';

    public function updatedTahun()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setTahun($tahun){
        $this->tahun = $tahun;
    }

    public function mount()
    {
        if(request()->tahun){
            $this->tahun          = request()->tahun;
        }
        $this->tahuns          = DokumenUmum::distinct()->pluck('tahun_terbit');
    }

    public function render()
    {
        $query = DokumenUmum::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => 'id',
            'order_direction' => 'desc',
        ]);
        $dokumenUmums = $query;
        if($this->tahun != ""){
            $dokumenUmums = $dokumenUmums->where('tahun_terbit', $this->tahun)->paginate(9);
        }
        else{
            $dokumenUmums = $query->paginate(9);
        }
        return view('livewire.guest.dokumen-umum.index', compact('dokumenUmums', 'query'))->extends('layouts.guest');
    }
}
