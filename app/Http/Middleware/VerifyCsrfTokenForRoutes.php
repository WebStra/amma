<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfTokenForRoutes extends BaseVerifier
{

    protected $excludeRoutes = [
        'add_product_image',
        'remove_product_image',
        'remove_product_spec',
        'sort_product_image'
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
        foreach ($this->excludeRoutes as $route) {
            if($request->route()->getName() == $route) {
                return $next($request);
            }
        }

        return parent::handle($request, $next);
    }
}