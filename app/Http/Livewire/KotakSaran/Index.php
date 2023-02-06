<?php

namespace App\Http\Livewire\KotakSaran;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\KotakSaran;
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
        $this->orderable         = (new KotakSaran())->orderable;
    }

    public function render()
    {
        $query = KotakSaran::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $kotakSarans = $query->paginate($this->perPage);

        return view('livewire.kotak-saran.index', compact('kotakSarans', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('kotak_saran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        KotakSaran::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(KotakSaran $kotakSaran)
    {
        abort_if(Gate::denies('kotak_saran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kotakSaran->delete();
    }
}
