<?php


namespace App\Services;

use App\Product;
use Illuminate\Session\Store;
use App\Events\PaymentProductsCreate;
use App\Repositories\ProductsRepository;
use App\Repositories\CategoryableRepository;
use Illuminate\Http\Request;

class CreateProductService extends Service
{
    /**
     * @var Store
     */
    protected $session;

    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * @var CategoryableRepository
     */
    protected $categoryable;

    /**
     * @var Product
     */
    protected $product = null;

    /**
     * CreateProductService constructor.
     * @param Store $session
     * @param ProductsRepository $productsRepository
     * @param CategoryableRepository $categoryableRepository
     */
    public function __construct(
        Store $session,
        ProductsRepository $productsRepository,
        CategoryableRepository $categoryableRepository
    )
    {
        $this->products = $productsRepository;
        $this->session = $session;
        $this->categoryable = $categoryableRepository;
    }

    /**
     * Handle service, create the product.
     * 
     * @param $product
     * @param $request
     */
    public function handle($product, Request $request)
    {
        $this->setProduct($this->products->update(
            $product,
            $request->all()
        ));

        // if (!is_null($categories = $request->get('categories')))
        //     $this->saveCategories($categories, $product);

        if (!empty($specs = $request->get('spec')))
            $this->saveSpecifications($specs);

        $this->clearProductFromSession();

        // check if user can pay the product..

//        event(new PaymentProductsCreate($this->getProduct()));
    }

    public function userPaymentInspection()
    {

    }

    /**
     * Set the product.
     *
     * @param Product $product
     * @return $this
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Check if product instance exists.
     *
     * @return bool
     */
    public function hasProduct()
    {
        return (bool) $this->product;
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
     * Save categories.
     *
     * @param $categories
     * @param Product $product
     */
    private function saveCategories($categories, Product $product)
    {
        // todo: rework this stuff.
        array_walk($categories, function ($category_id) use ($product) {
            $category = $this->categoryable->getByProductAndCategoryId(
                $product, $category_id
            );

            if(! count($category)) {
                if($category = $product->category)
                {
                    $category->category_id = $category_id;
                    $category->save();
                } else {
                    $this->categoryable->create((int)$category_id, $product);
                }
            }
        });
    }

    /**
     * Save specifications.
     *
     * @param $specifications
     * @param Product $product
     */
    private function saveSpecifications($specifications)
    {
        $product = $this->getProduct();

        array_walk($specifications, function ($meta) use ($product) {
            $product->setMeta($meta['key'], $meta['value'], 'spec');
        });
    }
}