<?php

namespace App\Http\Livewire\Admin\BerkasPelayanan;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\BerkasPelayanan;
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
        $this->orderable         = (new BerkasPelayanan())->orderable;
    }

    public function render()
    {
        $query = BerkasPelayanan::with(['pelayanan', 'syaratLayanan'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $berkasPelayanans = $query->paginate($this->perPage);

        return view('livewire.admin.berkas-pelayanan.index', compact('berkasPelayanans', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('berkas_pelayanan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        BerkasPelayanan::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(BerkasPelayanan $berkasPelayanan)
    {
        abort_if(Gate::denies('berkas_pelayanan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $berkasPelayanan->delete();
    }
}
