<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\UserRegisteredNotificationMail;

class UserObserver
{
    public function created(User $user)
    {
//        $user->notify(new UserRegisteredNotificationMail($user));
    }

    public function updated(User $user)
    {
        //
    }

    public function deleted(User $user)
    {
        //
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        //
    }
}
