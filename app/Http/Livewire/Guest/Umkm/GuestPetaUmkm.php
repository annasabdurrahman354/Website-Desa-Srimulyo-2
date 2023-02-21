<?php

namespace App\Http\Livewire\Guest\Umkm;

use App\Models\Umkm;
use Livewire\Component;

class GuestPetaUmkm extends Component
{

    public string $search = '';

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

    public function mount()
    {
    }

    public function render()
    {
        $query = Umkm::with(['pemilik', 'kategori'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => 'id',
            'order_direction' => 'desc',
        ]);

        $umkms = $query->get();

        return view('livewire.guest.umkm.peta', compact('query', 'umkms'));
    }
}
