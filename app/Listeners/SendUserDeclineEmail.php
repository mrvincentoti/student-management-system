<?php

namespace App\Listeners;

use App\Events\UserDecline;
use App\Mail\SendDeclineEmailToUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendUserDeclineEmail
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
     * @param  UserDecline  $event
     * @return void
     */
    public function handle(UserDecline  $event)
    {
        Log::info("Listening to you");
        Log::info($event);
        Log::info("end");
        //Mail::to($event->user)->send(new SendDeclineEmailToUser($event->user, $event->title, $event->message));
    }
}
