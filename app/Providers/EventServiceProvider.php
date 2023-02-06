<?php

namespace App\Providers;

use App\Models\BerkasPelayanan as BerkasPelayananModel;
use App\Models\KotakSaran as KotakSaranModel;
use App\Models\Pelayanan as PelayananModel;
use App\Models\Umkm as UmkmModel;
use App\Observers\BerkasPelayananObserver;
use App\Observers\KotakSaranObserver;
use App\Observers\PelayananObserver;
use App\Observers\UmkmObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        UmkmModel::observe(UmkmObserver::class);
        PelayananModel::observe(PelayananObserver::class);
        BerkasPelayananModel::observe(BerkasPelayananObserver::class);
        KotakSaranModel::observe(KotakSaranObserver::class);
    }
}
