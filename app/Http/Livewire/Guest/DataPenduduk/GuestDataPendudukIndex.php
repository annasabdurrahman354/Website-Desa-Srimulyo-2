<?php

namespace App\Http\Livewire\Guest\DataPenduduk;

use App\Models\ProdukHukum;
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
        $this->tahuns          = ProdukHukum::distinct()->pluck('tahun');
    }

    public function render()
    {
        $query = ProdukHukum::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => 'id',
            'order_direction' => 'desc',
        ]);
        $produkHukums = $query;
        if($this->tahun != ""){
            $produkHukums = $produkHukums->where('tahun', $this->tahun)->paginate(9);
        }
        else{
            $produkHukums = $query->paginate(9);
        }
        return view('livewire.guest.produk-hukum.index', compact('produkHukums', 'query'))->extends('layouts.guest');
    }
}
