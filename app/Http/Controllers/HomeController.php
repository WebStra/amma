<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductsRepository;
use Request;
use App\Visitors;
use Carbon\Carbon;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * @var CategoryRepository
     */
    protected $category;

    /**
     * HomeController constructor.
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductsRepository $productsRepository,CategoryRepository $categoryRepository)
    {
        $this->products = $productsRepository;
        $this->category = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->registerVisit();
        if ($filters = request()->all()) {

            $category = $this->category->getModel()->find(request()->get('category'));
            //$category = $this->category->getModel()->where('id',request()->get('category'))->first();

            if ($category) {
                $products = $this->products->search($filters);
                return view('home.search_result', compact('products','category'));
            }
        }

        return view('home.index');
    }

    /**
     * Get Client Ip and register in Database
     */
    public function registerVisit()
    {
        $ip = \Request::ip();

        if (count(Visitors::where('ip', $ip)->first()) == 0) {
            Visitors::create(['ip' => $ip]);
        }
    }

}