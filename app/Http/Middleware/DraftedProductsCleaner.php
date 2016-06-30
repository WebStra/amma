<?php

namespace App\Http\Middleware;

use App\Repositories\ProductsRepository;
use Closure;
use Illuminate\Session\Store;

class DraftedProductsCleaner
{
    /**
     * MUST be in 'web' group, set below
     * @reference middleware: \Illuminate\Session\Middleware\StartSession
     */

    /**
     * Except routename list.
     * @todo: find better solution.
     *
     * @var array
     */
    protected $except = [
        'post_create_product'
    ];

    /**
     * @var Store
     */
    protected $session;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * DraftedProductsCleaner constructor.
     * @param Store $session
     * @param ProductsRepository $productsRepository
     */
    public function __construct(
        Store $session, ProductsRepository $productsRepository
    )
    {
        $this->session = $session;
        $this->products = $productsRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $this->request = $request;

        if(! $request->ajax()) 
        {
            if (!in_array($this->getCurrentRouteName(), $this->except))
            {
                $product_id = $this->getDraftedProduct();

                if (!is_null($product_id)) {
                    $this->cleanDraftedProduct();

                    if ($product = $this->products->findDrafted($product_id))
                        $product->delete();
                }
            }
        }

        return $next($request);
    }

    /**
     * Get drafted product from session.
     *
     * @return mixed
     */
    private function getDraftedProduct()
    {
        return $this->session->get('drafted_product', null);
    }

    /**
     * Get current route name.
     *
     * @return string
     */
    private function getCurrentRouteName()
    {
        return $this->request->route()->getName();
    }

    /**
     * Remove product from session.
     *
     * @return void
     */
    private function cleanDraftedProduct()
    {
        $this->session->forget('drafted_product');
    }
}