<?php

namespace App\Http\Livewire\User\Pelayanan;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Pelayanan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class PelayananIndex extends Component
{
    use WithPagination;
    use WithSorting;
    use WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

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

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
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
        $query = Pelayanan::with(['pemohon', 'jenisLayanan'])->where('pemohon_id', auth()->user()->id)->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $pelayanans = $query->paginate($this->perPage);

        return view('livewire.user.pelayanan.index', compact('pelayanans', 'query'))->extends('layouts.user');
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('pelayanan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Pelayanan::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Pelayanan $pelayanan)
    {
        abort_if(Gate::denies('pelayanan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pelayanan->delete();
    }
}