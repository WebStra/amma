<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserCreationRequestSent;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Events\Dispatcher;
use App\Http\Controllers\Controller;
use Auth;
use Log;

class VerifyUserController extends Controller
{
    /**
     * @var UserRepository;
     */
    private $users;

    private $events;

    /**
     * VerifyUserController constructor.
     * @param UserRepository $users
     * @param Dispatcher $events
     */
    public function __construct(UserRepository $users, Dispatcher $events)
    {
        $this->users = $users;
        $this->events = $events;
    }
    
    /**
     * Confirm the account.
     *
     * @param $code
     * @return mixed
     */
    public function confirm(Request $request, $code)
    {
        $user = $this->users->getByConfirmationCode($code);

        if ($user) {
            if (! $user->confirmed) {
                
                $this->users->confirmate($user);
                
                return redirect()->guest('login')
                    ->with('status', 'You have successfully confirm your account.');
            } else {
                $message = 'You have already confirm the account.';

                return redirect()->route('get_login')->with('message', $message);
            }
        } else {
            $message = 'Invalid confirmation code.';

            abort('404', $message);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function resendConfirmationCode(Request $request)
    {
        $this->resendConfirmCodeforAuthUser();

        return redirect()->back()->withSuccess('Confirmation code was sent.');
    }

    /**
     * Resend verify form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resendVerify()
    {
        $this->resendConfirmCodeforAuthUser();

        return view('auth.resend_verify');
    }

    /**
     * Resend confirmation code.
     *
     * @return void.
     */
    private function resendConfirmCodeforAuthUser()
    {
        $user = \Auth::user();

        $user->confirmation_code = str_random(30);

        $user->save();

        $this->events->fire(new UserCreationRequestSent($user));
    }
}