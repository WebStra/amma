<?php

namespace App\Http\Controllers;

use App\Repositories\ProductsRepository;

class HomeController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * HomeController constructor.
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductsRepository $productsRepository)
    {
        $this->products = $productsRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if($filters = request()->all())
        {
            $products = $this->products->search($filters);
            
            return view('home.search_result', compact('products'));
        }

        return view('home.index');
    }
}