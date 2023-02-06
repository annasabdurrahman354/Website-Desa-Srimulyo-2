<?php

namespace App\Http\Livewire\ProdukHukum;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\ProdukHukum;
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
        $this->orderable         = (new ProdukHukum())->orderable;
    }

    public function render()
    {
        $query = ProdukHukum::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $produkHukums = $query->paginate($this->perPage);

        return view('livewire.produk-hukum.index', compact('produkHukums', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('produk_hukum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        ProdukHukum::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(ProdukHukum $produkHukum)
    {
        abort_if(Gate::denies('produk_hukum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $produkHukum->delete();
    }
}
