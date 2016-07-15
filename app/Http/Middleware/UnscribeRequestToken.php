<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;

class UnscribeRequestToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, \Closure $next)
    {
        $subscribe = $request->route()->getParameter('unscribe');

        if($subscribe)
        
            return $next($request);
      
        abort('404', 'Invalid token');
    }
}