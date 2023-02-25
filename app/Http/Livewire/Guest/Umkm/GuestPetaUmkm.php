<?php

namespace App\Http\Livewire\Guest\Umkm;

use App\Models\KategoriUmkm;
use App\Models\Umkm;
use Livewire\Component;

class GuestPetaUmkm extends Component
{
    public string $search = '';

    public $umkms = [];
    public $tags = [];
    public $clickedUmkm = '';

    public function setClickedUmkm($umkm){
        $this->clickedUmkm = $umkm;
    }

    public function mount()
    {
        $this->tags = Umkm::with('kategori')->distinct('kategori_id')->get(['kategori_id'])->pluck('kategori.kategori')->toArray();
    }

    public function render()
    {
        $query = Umkm::with(['pemilik', 'kategori'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => 'id',
            'order_direction' => 'desc',
        ]);
        
        $this->umkms = $query->get();

        $this->umkms = $this->umkms->map(function ($item) {
            $umkm = $item->toArray();
            $umkm['thumbUrl'] = $item->getFirstMediaUrl('umkm_carousel');
            $umkm['icon'] = $item->icon;
            $umkm['color'] = $item->color;
            $umkm['url_arah'] = $item->url_arah;
            $umkm['url_hubungi'] = $item->url_hubungi;
            unset($umkm['carousel']);
            unset($umkm['media']);
            return $umkm;
        });

        $umkms = $this->umkms;

        return view('livewire.guest.umkm.umkm-peta', compact('query', 'umkms'))->extends('layouts.guest');
    }
}
