<?php

namespace App\Http\Middleware;

use App\Repositories\LotRepository;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class AddLotMiddleware
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @var LotRepository
     */
    protected $lots;

    /**
     * AddLotMiddleware constructor.
     * @param Guard $auth
     * @param LotRepository $lotRepository
     */
    public function __construct(Guard $auth, LotRepository $lotRepository)
    {
        $this->auth = $auth;
        $this->lots = $lotRepository;
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
        // add complete to lot.
        // Снять со счета и зарегать .
//        if (Auth::guard($guard)->guest()) {
//            if ($request->ajax() || $request->wantsJson()) {
//                return response('Unauthorized.', 401);
//            } else {
//                return redirect()->guest('login');
//            }
//        }

        return $next($request);
    }
}