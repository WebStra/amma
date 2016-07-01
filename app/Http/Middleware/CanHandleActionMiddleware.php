<?php

namespace App\Http\Middleware;

use App\Http\Requests\Request;
use Auth;

class CanHandleActionMiddleware
{
    /**
     * @var Request
     */
    private $request;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next, $parameter)
    {
        $this->request = $request;

        $user_holder = $this->getObjectHolder(
            $this->getRouteParameter($parameter)
        );

        if ($user_holder && Auth::id() == $user_holder->id)
            return $next($request);

        $this->abort();
    }

    /**
     * Get model from parameter from route.
     *
     * @param $parameter
     * @return \Illuminate\Routing\Route|object|string
     */
    private function getRouteParameter($parameter)
    {
        return $this->request->route($parameter);
    }

    /**
     * Get user of this object.
     *
     * @param $model
     * @return mixed
     */
    private function getObjectHolder($model)
    {
        if($model)
            return $model->user()->first();

        $this->abort();
    }

    /**
     * Abort connection.
     */
    private function abort()
    {
        return abort('404');
    }
}