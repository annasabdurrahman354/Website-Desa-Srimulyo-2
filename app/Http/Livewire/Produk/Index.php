<?php

namespace App\Http\Livewire\Produk;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Produk;
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
        $this->orderable         = (new Produk())->orderable;
    }

    public function render()
    {
        $query = Produk::with(['umkm', 'satuan', 'kategori'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $produks = $query->paginate($this->perPage);

        return view('livewire.produk.index', compact('produks', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('produk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Produk::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Produk $produk)
    {
        abort_if(Gate::denies('produk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $produk->delete();
    }
}
