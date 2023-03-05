<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminNotification extends Component
{
    public $alerts = [];
    
    public function mount()
    {
        $this->alerts = auth()->user()->alerts()->latest()->take(10)->get();
    }

    public function setSeen($alert){
        redirect($alert['link']);
        auth()->user()->alerts()
            ->newPivotStatement()
            ->where('user_id', auth()->id())
            ->where('user_alert_id', $alert['id'])
            ->whereNull('seen_at')
            ->update(['seen_at' => now()]);
    }

    public function render()
    {
        return view('livewire.admin-notification');
    }
}
