<?php

namespace App\Providers;

use App\Http\ViewComposers\BannerComposer;
use App\Http\ViewComposers\BlogComposer;
use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\FaqComposer;
use App\Http\ViewComposers\HomePageComposer;
use App\Http\ViewComposers\LanguageComposer;
use App\Http\ViewComposers\PagesComposer;
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
        
        view()->composer(['partials.categories.*', 'product.partials.*'], CategoryComposer::class);

        view()->composer('partials.header.language-bar', LanguageComposer::class);

        view()->composer('blog.partials.popular-sidebar', BlogComposer::class);
     
        view()->composer([
            'partials.header.index', 'partials.footer.navigation_sidebar'
        ], PagesComposer::class);

        view()->composer(['home.index'], HomePageComposer::class);

        view()->composer('pages.support', FaqComposer::class);
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