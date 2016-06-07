<?php

namespace App\Providers;

use App\Repositories\BannerRepository;
use App\Repositories\PartnerRepository;
use App\Repositories\SocialRepository;
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
        view()->composer('partials.footer.partners', function ($view) {
            $partnerRepository = new PartnerRepository();
            
            return $view->with('partners', $partnerRepository->getFooterList());
        });

        view()->composer('partials.footer.socials', function ($view) {
            $socialRepository = new SocialRepository();

            return $view->with('socials', $socialRepository->getFooterList());
        });

        view()->composer('partials.banners.extended', function ($view) {
            $bannerRepository = new BannerRepository();

            return $view->with('banners', $bannerRepository->getExtendedAddBlocks(2));
        });

        view()->composer('partials.banners.small', function ($view) {
            $bannerRepository = new BannerRepository();

            return $view->with('banners', $bannerRepository->getSmallAddBlocks(2));
        });

        view()->composer('partials.banners.sidebar', function ($view) {
            $bannerRepository = new BannerRepository();

            return $view->with('banners', $bannerRepository->getRightSideBarAddBlocks(1));
        });
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