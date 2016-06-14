<?php

namespace App\Http\Controllers;

use App\Repositories\ProductsRepository;

class ProductsController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * ProductsController constructor.
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductsRepository $productsRepository)
    {
        $this->products = $productsRepository;
    }

    /**
     * Show inner product.
     *
     * @param $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($product)
    {
        return view('product.show')->withItem($product);
    }
}