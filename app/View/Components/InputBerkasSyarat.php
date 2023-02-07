<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputBerkasSyarat extends Component
{
    public $berkas_pelayanan;
 
    public function mount($berkas_pelayanan)
    {
        $this->berkas_pelayanan = $berkas_pelayanan;
    }

    public function render()
    {
        return view('components.input-berkas-pelayanan');
    }
}
