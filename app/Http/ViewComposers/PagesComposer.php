<?php

namespace App\Http\ViewComposers;

use App\Repositories\PagesRepository;
use Illuminate\Contracts\View\View;

class PagesComposer extends Composer
{
    /**
     * @var PagesRepository
     */
    protected $pages;

    /**
     * PagesComposer constructor.
     * @param PagesRepository $pagesRepository
     */
    public function __construct(PagesRepository $pagesRepository)
    {
        $this->pages = $pagesRepository;
    }

    /**
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        switch ($view->getName())
        {
            case "partials.header.index":
                return $view->with('pages', $this->pages->getHeader());
                break;

            case "partials.footer.navigation_sidebar":
                return $view->with('pages', $this->pages->getFooter());
                break;
        }
    }
}