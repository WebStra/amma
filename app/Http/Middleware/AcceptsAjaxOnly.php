<?php

namespace App\Http\Middleware;

class AcceptsAjaxOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        if($request->ajax())
            return $next($request);

        abort('404');
    }
}