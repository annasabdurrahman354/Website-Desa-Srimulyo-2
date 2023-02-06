<?php

namespace App\Observers;

use App\Models\Pelayanan;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class PelayananObserver
{
    public function created(Pelayanan $pelayanan): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($pelayanan), $pelayanan->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
