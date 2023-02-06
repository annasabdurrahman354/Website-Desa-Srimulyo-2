<?php

namespace App\Observers;

use App\Models\KotakSaran;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class KotakSaranObserver
{
    public function created(KotakSaran $kotakSaran): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($kotakSaran), $kotakSaran->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
