<?php

namespace App\Http\Livewire\Guest\Artikel;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Livewire\Component;
use Livewire\WithPagination;

class GuestArtikelIndex extends Component
{
    use WithPagination;
    use WithSorting;
    use WithConfirmation;

    public array $orderable;

    public $kategoris = [];

    public string $kategoriNama = 'Semua Kategori';

    public string $kategoriId = "";

    public string $search = '';

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => [
                'id',
                'judul',
                'konten',
                'jumlah_pembaca',
            ],
        ],
        'sortBy' => [
            'except' => '',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function updatedKategori()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setKategori($kategoriId, $kategoriNama){
        $this->kategoriNama = $kategoriNama;
        $this->kategoriId = $kategoriId;
    }

    public function mount()
    {
        if(request()->kategori){
            $this->kategoriId          = request()->kategori;
            $this->kategoriNama        = KategoriArtikel::where('id', $this->kategoriId)->first()->kategori;
        }
        $this->kategoris          = KategoriArtikel::get();
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Artikel())->orderable;
    }

    public function render()
    {
        $query = Artikel::with(['penulis', 'kategori'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);
        $artikels = $query;
        if($this->kategoriId != ""){
            $artikels = $artikels->where('kategori_id', $this->kategoriId)->paginate(9);
        }
        else{
            $artikels = $query->paginate(9);
        }
        return view('livewire.guest.artikel.index', compact('artikels', 'query'))->extends('layouts.guest');
    }
}
