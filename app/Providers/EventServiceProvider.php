<?php

namespace App\Providers;

use App\Events\PaymentProductsCreate;
use App\Events\PostWasViewed;
use App\Events\UserCreationRequestSent;
use App\Listeners\ProductCreateWithdrawal;
use App\Listeners\SendConfirmationCode;
use App\Listeners\ViewPostHandler;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PostWasViewed::class => [
            ViewPostHandler::class
        ],
        
        UserCreationRequestSent::class => [
            SendConfirmationCode::class
        ],

        PaymentProductsCreate::class => [
            ProductCreateWithdrawal::class
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
