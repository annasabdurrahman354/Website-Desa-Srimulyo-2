<?php

namespace App\Http\Livewire\DokumenUmum;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\DokumenUmum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
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
        $this->orderable         = (new DokumenUmum())->orderable;
    }

    public function render()
    {
        $query = DokumenUmum::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $dokumenUmums = $query->paginate($this->perPage);

        return view('livewire.dokumen-umum.index', compact('dokumenUmums', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('dokumen_umum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        DokumenUmum::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(DokumenUmum $dokumenUmum)
    {
        abort_if(Gate::denies('dokumen_umum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dokumenUmum->delete();
    }
}
