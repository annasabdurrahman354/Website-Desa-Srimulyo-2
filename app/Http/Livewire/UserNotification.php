<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserNotification extends Component
{
    public $notifikasis = [];

    public function mount()
    {
        $this->notifikasis   = auth()->user()->alerts()->latest()->take(10)->get();
    }

    public function render()
    {
        return view('livewire.user-notification');
    }
}
