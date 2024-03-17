<?php

namespace App\Providers;

use App\Events\UserRegisteredEvent;
use App\Listeners\SendMailNotification;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserRegisteredEvent::class => [
            SendMailNotification::class,
        ],
    ];
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
