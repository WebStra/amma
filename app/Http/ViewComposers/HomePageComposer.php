<?php

namespace App\Http\ViewComposers;

use App\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\PostsRepository;
use App\Repositories\ProductsRepository;
use Illuminate\Contracts\View\View;

class HomePageComposer extends Composer
{
    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * @var PostsRepository
     */
    protected $posts;

    /**
     * HomePageComposer constructor.
     * @param ProductsRepository $productsRepository
     * @param CategoryRepository $categoryRepository
     * @param PostsRepository $postsRepository
     */
    public function __construct(
        ProductsRepository $productsRepository,
        CategoryRepository $categoryRepository,
        PostsRepository $postsRepository
    )
    {
        $this->products = $productsRepository;
        $this->categories = $categoryRepository;
        $this->posts = $postsRepository;
    }

    /**
     * Bind data to view.
     *
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {
        switch ($view->getName()) {
            case "home.index":
                $category_1 = $this->categories->find(settings()->getOption('home::category_first'));
                $category_2 = $this->categories->find(settings()->getOption('home::category_second'));

                return $view
                    ->with('popular_category', $this->categories->getPopularCategory())
                    ->with('recommended', [
                        'name' => 'oferte recomandate',
                        'data' => function () {
                            return $this->products->getFeaturedPublic(4);
                        }
                    ])
                    ->with('posts', [
                        'name' => 'articole de blog',
                        'data' => function (){
                            return $this->posts->getPopularPublic();
                        }
                    ])
                    ->with('expire', [
                        'name' => 'produse care expira in curand',
                        'label' => 'info_corner.png',
                        'data' => function ($count = 8) {
                            return $this->products->getPublicExpireSoon($count);
                        }
                    ])
                    ->with('popular', [
                        'name' => 'produse populare',
                        'data' => function () {
                            return $this->products->getFeaturedPublic(15);
                        }
                    ])
                    ->with('category_1', [
                        'name' => ($category_1) ? $category_1->name : '',
                        'data' => function () use ($category_1){
                            $products = [];

                            if($category_1)
                            $category_1->categoryables()
                                ->active()
                                ->elementType(get_class($this->products->getModel()))
                                ->get()
                                ->each(function ($morph) use (&$products) {
                                    $products[] = $morph->categoryable;
                                });

                            return $products;
                        }
                    ])
                    ->with('category_2', [
                        'name' => ($category_2) ? $category_2->name : '',
                        'data' => function () use ($category_2){
                            $products = [];

                            if($category_2)
                            $category_2->categoryables()
                                ->active()
                                ->elementType(get_class($this->products->getModel()))
                                ->get()
                                ->each(function ($morph) use (&$products) {
                                    $products[] = $morph->categoryable;
                                });

                            return $products;
                        }
                    ])
                    ->with('latest', [
                        'name' => 'latest',
                        'data' => function () {
                            return $this->products->getPublicLatest();
                        }
                    ]);
                break;

        }
    }
}