<?php

namespace App\Mail;

use App\User; 

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class SendDeclineEmailToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $title;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $title = null, $message = null)
    {
        $this->user = $user;
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->subject('Welcome to ' . config('app.name'))->markdown('email.user.decline')
                ->with([
                    'title' => $this->title,
                    'email' => $this->user->email,
                    'message' => $this->message,
                    'name' => $this->$this->user->name,
                ]);
    }
}
