<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Repositories\CategoryableRepository;
use Illuminate\Session\Store;
use App\Repositories\ProductsRepository;
use App\Repositories\UserProductsRepository;

class ProductsController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $products;

    protected $categoryable;
    
    protected $userProducts;

    protected $session;

    /**
     * ProductsController constructor.
     * @param ProductsRepository $productsRepository
     */
    public function __construct(
        Store $session,
        ProductsRepository $productsRepository,
        CategoryableRepository $categoryableRepository,
        UserProductsRepository $userProductsRepository
    )
    {
        $this->session = $session;
        $this->products = $productsRepository;
        $this->categoryable = $categoryableRepository;
        $this->userProducts = $userProductsRepository;
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

    /**
     * Get create product form.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate($vendor)
    {
        $product = $this->createPlainProduct($vendor->id);

        $this->session->put('drafted_product', $product->id);

        return view('product.create', ['vendor' => $vendor, 'item' => $product]);
    }

    public function postCreate(ProductCreateRequest $request, $vendor)
    {
        dd($request->all());
        $product = $this->products->create($request->all(), $vendor);

        $categories = $request->get('categories');
        if(isset($categories)){
            array_walk($categories, function ($category_id) use ($product) {
                // $category = $this->categoryable->find($category_id);

                $this->categoryable->create((int)$category_id, $product);
            });
        }

        $colors = $request->get('colors');
        if(isset($colors)){
            $colors = json_decode($colors);

            foreach ($colors as $color){
                ProductsColors::create([
                    'product_id' => $product->id,
                    'color_hash' => $color
                ]);
            }
        }

        return redirect()->route('view_product', ['product' => $product->id]);
    }
    
    /**
     * Create plain product.
     * 
     * @param $vendor_id
     * @return \App\Product
     */
    private function createPlainProduct($vendor_id)
    {
        $plain_product = $this->products->create([
            'status' => 'drafted',
            'active' => 0
        ]);
        
        $this->userProducts->create($vendor_id, $plain_product->id);
        
        return $plain_product;
    }
}