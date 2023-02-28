<?php

namespace App\Http\Livewire\Guest\DataPenduduk;

use App\Models\DataPenduduk;
use Livewire\Component;
use Livewire\WithPagination;

class GuestDataPendudukIndex extends Component
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
        $this->tahuns          = DataPenduduk::distinct()->pluck('tahun_pembaruan');
    }

    public function render()
    {
        $query = DataPenduduk::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => 'id',
            'order_direction' => 'desc',
        ]);
        $dataPenduduks = $query;
        if($this->tahun != ""){
            $dataPenduduks = $dataPenduduks->where('tahun_pembaruan', $this->tahun)->paginate(9);
        }
        else{
            $dataPenduduks = $query->paginate(9);
        }
        return view('livewire.guest.data-penduduk.index', compact('dataPenduduks', 'query'))->extends('layouts.guest');
    }
}
