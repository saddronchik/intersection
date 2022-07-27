<?php

namespace App\Listeners;

use App\Notifications\Users;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $admins = User::whereHas('roles', function ($query) {
        //         $query->where('id', 1);
        //     })->get();

        // Notification::send($admins, new Users($event->user));
    }
}
