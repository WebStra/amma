<?php

namespace App\Http\Middleware;

use App\Repositories\InvolvedRepository;

class UserCanInvolveProduct
{
    protected $product;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $this->product = $request->route()->getParameter('product');
        $times = config('product.times');

        if ((!empty($times)) && ($this->getUserInvolvesTimes() < 3))
            return $next($request);

        return redirect()->back()->withStatus('Sorry! But you can\'t involve this product.');
    }

    /**
     * Get user's involves times.
     *
     * @return int
     */
    private function getUserInvolvesTimes()
    {
        return (new InvolvedRepository())->getInvolveTimesProduct($this->product);
    }
}