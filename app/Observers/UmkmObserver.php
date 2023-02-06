<?php

namespace App\Observers;

use App\Models\Umkm;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class UmkmObserver
{
    public function created(Umkm $umkm): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($umkm), $umkm->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
