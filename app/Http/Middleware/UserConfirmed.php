<?php

namespace App\Http\Middleware;

use Auth;
use Illuminate\Session\Store;

class UserConfirmed
{
    /**
     * @var Store
     */
    private $session;

    protected $excludeRoutes = [
        'resend_verify_email_form',
        'resend_verify_email',
        'verify_email',
        'logout'
    ];

    /**
     * UserConfirmed constructor.
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->confirmed)
                return $next($request);

            foreach ($this->excludeRoutes as $route) {
                if($request->route()->getName() == $route) {
                    return $next($request);
                }
            }

            Auth::logout();
            return redirect()->route('home');
        }

        return $next($request);
    }
}