<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Repositories\CategoryableRepository;
use App\Repositories\ProductsColorsRepository;
use App\Services\ImageProcessor;
use Illuminate\Http\UploadedFile;
use Illuminate\Session\Store;
use App\Repositories\ProductsRepository;

class ProductsController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * @var CategoryableRepository
     */
    protected $categoryable;

    /**
     * @var Store
     */
    protected $session;

    /**
     * @var ProductsColorsRepository
     */
    protected $productsColors;


    /**
     * ProductsController constructor.
     * @param Store $session
     * @param ProductsRepository $productsRepository
     * @param CategoryableRepository $categoryableRepository
     * @param ProductsColorsRepository $productsColorsRepository
     */
    public function __construct(
        Store $session,
        ProductsRepository $productsRepository,
        CategoryableRepository $categoryableRepository,
        ProductsColorsRepository $productsColorsRepository
    )
    {
        $this->session = $session;
        $this->products = $productsRepository;
        $this->categoryable = $categoryableRepository;
        $this->productsColors = $productsColorsRepository;
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

    /**
     * @param ProductCreateRequest $request
     * @param \App\Vendor $vendor
     * @param \App\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSave(ProductCreateRequest $request, $vendor = null, $product = null)
    {
        $product = $this->products->update(
            $product,
            $request->all()
        );

        if(! is_null($categories = $request->get('categories')))
            $this->saveCategories($categories, $product);

        if(! is_null($colors = $request->get('colors')))
            $this->saveColors($colors, $product);

        if(! is_null($images = $request->get('images')))
            $this->saveImages($images, $product);

        if(! ($spec = $request->get('spec')))
            $this->saveImages($images, $product);

        $this->clearProductFromSession();

        return redirect()->route('view_product', ['product' => $product->id]);
    }

    /**
     * @param $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditForm($product)
    {
        return view('product.edit', ['item' => $product]);
    }

    /**
     * @param ProductCreateRequest $request
     * @param $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductCreateRequest $request, $product)
    {
        return $this->postSave($request, $product);
    }

    /**
     * Create plain product.
     *
     * @param $vendor_id
     * @return \App\Product
     */
    private function createPlainProduct($vendor_id)
    {
        return $this->products->create([
            'vendor_id' => $vendor_id,
            'status' => 'drafted',
            'active' => 0
        ]);
    }

    /**
     * Clean session from drafted products.
     *
     * @return void
     */
    private function clearProductFromSession()
    {
        $this->session->forget('drafted_product');
    }

    /**
     * @param $categories
     * @param $product
     */
    private function saveCategories($categories, $product)
    {
        array_walk($categories, function ($category_id) use ($product) {
            // $category = $this->categoryable->find($category_id);

            $this->categoryable->create((int)$category_id, $product);
        });
    }

    /**
     * @param $colors
     * @param $product
     */
    private function saveColors($colors, $product)
    {
        $colors = json_decode($colors);

        foreach ($colors as $color)
        {
            $this->productsColors->create($product, $color);
        }
    }

    /**
     * @param $specifications
     * @param $product
     */
    private function saveSpecifications($specifications, $product)
    {
        array_walk($specifications, function ($meta) use ($product){
            $product->setMeta($meta['key'], $meta['value'], 'spec');
        });
    }

    /**
     * @param $images
     * @param $product
     */
    private function saveImages($images, $product)
    {
        array_walk($images, function($image) use($product) {
            if ($image instanceof UploadedFile) {
                $location = 'upload/products/' . $product->id;
                $processor = new ImageProcessor();
                $processor->uploadAndCreate($image, $product, null, $location);
            }
        });
    }
}