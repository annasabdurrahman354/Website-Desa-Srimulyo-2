<?php

namespace App\Http\Livewire\User\Home;

use Livewire\Component;
use Livewire\WithPagination;

class UserHomeIndex extends Component
{
    use WithPagination;
    
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
        $alerts = auth()->user()->alerts()->latest()->paginate(5);
        return view('livewire.user.home.index',  compact('alerts'))->extends('layouts.user');
    }

    public function paginationView()
    {
        return 'components.user-pagination';
    }
}
