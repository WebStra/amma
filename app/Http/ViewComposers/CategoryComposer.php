<?php

namespace App\Http\ViewComposers;

use App\Repositories\CategoryRepository;
use Illuminate\Contracts\View\View;

class CategoryComposer extends Composer
{
    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * CategoryComposer constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categories = $categoryRepository;
    }

    /**
     * Bind data to view.
     * 
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {
        switch ($view->getName()){
            case "partials.categories.l_sidebar":
                return $view->with('categories', $this->categories->getSidebarCollection());
                break;

            case "partials.categories.footer":
                return $view->with('categories', $this->categories->getFooterCollection());
                break;

            case "partials.categories.header_dropdown":
                return $view->with('categories', $this->categories->getSidebarCollection()); // the same select like l_sidebar
                break;

            case "partials.categories.search_dropdown":
                return $view->with('categories', $this->categories->getSidebarCollection()); // the same select like l_sidebar
                break;
        }
    }
}