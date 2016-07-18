<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\SocialiteServiceProvider as BaseSocialiteServiceProvider;

class SocialiteServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Provider register.
     *
     * @return void
     */
    public function register()
    {
        if (class_exists(BaseSocialiteServiceProvider::class))
            $this->loadRegister();
    }

    /**
     * Load register.
     *
     * @return void
     */
    public function loadRegister()
    {
        $this->app->singleton('Laravel\Socialite\Contracts\Factory', function ($app) {
            return new SocialiteManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Laravel\Socialite\Contracts\Factory'];
    }
}