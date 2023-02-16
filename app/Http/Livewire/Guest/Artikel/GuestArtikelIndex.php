<?php

namespace App\Http\Livewire\Guest\Artikel;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Artikel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class GuestArtikelIndex extends Component
{
    use WithPagination;
    use WithSorting;
    use WithConfirmation;

    public array $orderable;

    public string $kategori = '';

    public string $search = '';

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
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


    public function mount()
    {
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

        $artikels = $query->paginate(10);

        return view('livewire.guest.artikel.index', compact('artikels', 'query'))->extends('layouts.guest');
    }
}
