<?php

namespace App\Http\Livewire;

use App\Models\UserAlert;
use Livewire\Component;

class UserNotification extends Component
{
    public $alerts = [];
    
    public function mount()
    {
        $this->alerts = auth()->user()->alerts()->latest()->take(5)->get();
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
        return view('livewire.user-notification');
    }
}
