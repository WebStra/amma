<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * Login by email.
     * 
     * @var string
     */
    public $username = 'email';

    /**
     * AuthController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository = null)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->users = $userRepository;
    }

    /**
     * Get recover password page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRecover()
    {
        return view('auth.recover');
    }

    public function postLogin(LoginUserRequest $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {

            if ($throttles) {
                $this->clearLoginAttempts($request);
            }

            if (method_exists($this, 'authenticated')) {
                return $this->authenticated($request, Auth::guard($this->getGuard())->user());
            }

            // todo: HIGH. Fix it!!!
//            if(session()->pull('url.intended', '/') == route('admin_login'))
//                return redirect()->to('/');

            return redirect()->intended($this->redirectPath());
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function postRegister(RegisterUserRequest $request)
    {
        Auth::guard($this->getGuard())->login($this->users->createSimpleUser($request->all()));

        return redirect($this->redirectPath());
    }
}
