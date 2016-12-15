<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfTokenForRoutes extends BaseVerifier
{

    protected $excludeRoutes = [
        'add_product_image',
        'remove_product_image',
        'remove_product_spec',
        'remove_product_spec_price',
        'sort_product_image',
        'resend_verify_email',
        'involve_product',
        'involve_product_cancel',
        'vote_vendor',
        'filter_category',
        'load_product_block_form',
        'view_category',
        'lot_select_category',
        'delete_product',
        'load_spec',
        'load_spec_price',
        'remove_product_improved_spec',
        'load_improved_spec',
        'delete_group_price',
//        'save_product'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach ($this->excludeRoutes as $route)
            if($request->route()->getName() == $route)
                return $next($request);

        return parent::handle($request, $next);
    }
}