<?php

namespace App\Listeners;

use App\Mail\UserEmailNotify;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserEmailNotifyListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Mail::to($event->user->email)->send(new UserEmailNotify($event->user));

    }
}
