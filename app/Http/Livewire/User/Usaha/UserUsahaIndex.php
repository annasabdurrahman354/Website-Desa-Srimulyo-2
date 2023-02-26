<?php

namespace App\Http\Livewire\User\Usaha;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Produk;
use App\Models\Umkm;
use Livewire\Component;
use Livewire\WithPagination;

class UserUsahaIndex extends Component
{
    use WithPagination;
    use WithSorting;
    use WithConfirmation;

    public $umkm;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 10;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Produk())->orderable;
        $this->umkm              = Umkm::where('pemilik_id', auth()->user()->id)->first();
    }

    public function render()
    {

        $query = Produk::join('umkms', 'produks.umkm_id', '=', 'umkms.id')
                        ->where('umkms.pemilik_id', '=', auth()->user()->id)
                        ->with(['satuan', 'kategori'])
                        ->advancedFilter([
                            's'               => $this->search ?: null,
                            'order_column'    => $this->sortBy,
                            'order_direction' => $this->sortDirection,
        ]);

        $produks = $query->paginate($this->perPage);
        return view('livewire.user.usaha.index', compact('produks', 'query'))->extends('layouts.user');
    }

    public function delete(Produk $produk)
    {
        $produk->delete();
    }
}
