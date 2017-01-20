<?php

namespace App\Http\Middleware;

use App\Lot;
use App\Repositories\LotRepository;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class EditLotMiddleware
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
        if($lot = $request->route('lot'))
        {
            if (in_array($lot->verify_status, array('expired','declined','drafted')) or $lot->status == 'drafted') {
               return $next($request);
            }else{
                abort('404');
            }
        }
        return redirect()->back()->withSuccess('Something Wrong!');
    }
}