<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputBerkasSyarat extends Component
{
    public $berkas_syarat;
 
    public function mount($berkas_syarat)
    {
        $this->berkas_syarat = $berkas_syarat;
    }

    public function render()
    {
        return view('components.input-berkas-syarat');
    }
}
