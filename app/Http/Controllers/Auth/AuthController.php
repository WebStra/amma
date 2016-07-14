<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserCreationRequestSent;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Events\Dispatcher;
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
     * @var WalletRepository
     */
    protected $wallets;

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
     * @param WalletRepository $walletRepository
     */
    public function __construct(
        UserRepository $userRepository = null,
        WalletRepository $walletRepository = null
    )
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->users = $userRepository;
        $this->wallets = $walletRepository;
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

    /**
     * @param LoginUserRequest $request
     * @param Dispatcher $events
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function postLogin(LoginUserRequest $request, Dispatcher $events)
    {
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if(Auth::validate($credentials))
        {
            if(! $this->users->getByEmail($credentials['email'])->active)
                return redirect()->back()
                    ->withErrors(['account' => 'This account has blocked. Please contact the support.']);
        }

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

            $user = Auth::user();

            // todo: be carefull this code can be bugged.
            if(! $user->wallets()->sandbox()->first())
            {
                $this->createTestWallet($user);
            }

            if(! $user->confirmed)
                return redirect()->route('resend_verify_email_form');
            
            return redirect()->intended($this->redirectPath());
        }

        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Post register.
     *
     * @param RegisterUserRequest $request
     * @param Dispatcher $events
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegisterUserRequest $request, Dispatcher $events)
    {
        $user = $this->users->createSimpleUser($request->all());
        
        $events->fire(new UserCreationRequestSent($user));

        $this->createTestWallet($user);

        Auth::guard($this->getGuard())->login($user);

        return redirect()->route('resend_verify_email_form');
    }

    /**
     * Create test wallet.
     *
     * @param $user
     */
    private function createTestWallet($user)
    {
        if(settings()->getOption('site::testing_payment_period'))
        {
            $wallet = $this->wallets->create($user, [
                'type' => $this->wallets->getTest()
            ]);

            $this->wallets->refillWallet($wallet, config('testing_payment.amount'));
        }
    }
}