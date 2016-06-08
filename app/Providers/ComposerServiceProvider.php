<?php

namespace App\Providers;

use App\Http\ViewComposers\BannerComposer;
use App\Http\ViewComposers\PartnerComposer;
use App\Http\ViewComposers\SocialComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.footer.partners', PartnerComposer::class);

        view()->composer('partials.footer.socials', SocialComposer::class);

        view()->composer('partials.banners.*', BannerComposer::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}