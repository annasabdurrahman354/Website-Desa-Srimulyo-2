<?php

namespace App\Observers;

use App\Models\BerkasPelayanan;
use App\Models\User;
use App\Notifications\DataChangeEmailNotification;
use Notification;

class BerkasPelayananObserver
{
    public function created(BerkasPelayanan $berkasPelayanan): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($berkasPelayanan), $berkasPelayanan->id),
            'reason' => auth()->user(),
        ];

        $admins = User::admins()->get();

        Notification::send($admins, new DataChangeEmailNotification($payload));
    }
}
