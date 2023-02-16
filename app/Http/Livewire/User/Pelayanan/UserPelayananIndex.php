<?php

namespace App\Http\Livewire\User\Pelayanan;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Pelayanan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class UserPelayananIndex extends Component
{
    use WithPagination;
    use WithSorting;
    use WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => [
                'id',
                'pemohon.name',
                'pemohon.nomor_telepon',
                'catatan_pemohon',
                'rating',
                'penilaian_pemohon'
            ],
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
        $this->perPage           = 25;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Pelayanan())->orderable;
    }

    public function render()
    {
        $query = Pelayanan::with(['pemohon', 'jenisLayanan'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $pelayanans = $query->where('pemohon_id', auth()->user()->id)->paginate($this->perPage);
        return view('livewire.user.pelayanan.index', compact('pelayanans', 'query'))->extends('layouts.user');
    }

    public function delete(Pelayanan $pelayanan)
    {
        abort_if(Gate::denies('pelayanan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pelayanan->delete();
    }
}
