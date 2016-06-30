<?php

namespace App\Providers;

use App\Image;
use App\Listeners\Observers\ImageObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * List of observers which belongs to models
     *
     * @var array
     */
    protected $observers = [
        Image::class => ImageObserver::class
    ];

    /**
     * Register observers.
     *
     * @return void.
     */
    public function register()
    {
        //
    }

    /**
     * Registering observers SHOULD BE in boot() method.
     * 
     * @return void.
     */
    public function boot()
    {
        array_walk($this->observers, function ($observer, $model) {
            $model::observe(new $observer);
        });
    }
}