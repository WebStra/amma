<?php

namespace App\Http\ViewComposers;

use App\Repositories\BannerRepository;
use Illuminate\Contracts\View\View;

class BannerComposer extends Composer
{
    /**
     * @var BannerRepository
     */
    protected $banners;

    /**
     * BannerComposer constructor.
     * @param BannerRepository $bannerRepository
     */
    public function __construct(BannerRepository $bannerRepository)
    {
        $this->banners = $bannerRepository;
    }

    /**
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        // Here template names is hardcoded, but here is easy to edit them, then go to templates and change variables there

        switch ($view->getName()){
            case "partials.banners.small":
                return $view->with('banners', $this->banners->getSmallAdBlocks(2));
                break;

            case "partials.banners.r_sidebar":
                return $view->with('banners', $this->banners->getRightSideBarAdBlocks(1));
                break;

            case "partials.banners.big":
                return $view->with('banners', $this->banners->getBigAdBlocks(2));
                break;
        }
    }
}