<?php

namespace App\Listeners;

use App\Events\UserCreationRequestSent;
use Illuminate\Foundation\Application;
use Illuminate\Mail\Message;
use Keyhunter\Administrator\Filters\QueryableTrait;
use Illuminate\Bus\Queueable;


class SendConfirmationCode
{
//    use QueryableTrait, Queueable;

    /**
     * @var Application
     */
    private $application;

    /**
     * Create the event handler.
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Handle the event.
     *
     * @param  UserCreationRequestSent  $event
     * @return void
     */
    public function handle(UserCreationRequestSent $event)
    {
        $user    = $event->getUser();

        \Mail::send('email.verify', compact('user'), function(Message $message) use ($user)
        {
            $message->to($user->email, sprintf('%s %s', $user->profile->firstname, $user->profile->lastname))
                ->subject("Verify your email address");
        });
    }
}