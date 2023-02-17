<?php

namespace App\Http\Livewire\Admin\Artikel;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Artikel;
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
            'except' => 'konten',
        ],
        'sortBy' => [
            'except' => ['id' ,"konten"],
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
        $this->orderable         = (new Artikel())->orderable;
    }

    public function render()
    {
        $query = Artikel::with(['penulis', 'kategori'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $artikels = $query->paginate($this->perPage);

        return view('livewire.admin.artikel.index', compact('artikels', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('artikel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Artikel::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Artikel $artikel)
    {
        abort_if(Gate::denies('artikel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artikel->delete();
    }
}
