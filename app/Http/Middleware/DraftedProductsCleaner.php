<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;

class DraftedProductsCleaner
{
    /**
     * @var Store
     */
    protected $session;

    /**
     * ViewThrottleMiddleware constructor.
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
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
        $product = $this->getDraftedProduct();
        // todo: implement stuff.
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }

    private function draftedProduct()
    {
        return $this->session->get('drafted_product', null);
    }
}