<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\GetEmailFormRequest;
use App\Http\Requests\SocialiteUserSaveEmailRequest;
use App\Repositories\UserRepository;
use App\Services\SocialiteUser;
use App\User;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Http\Controllers\Controller;

class SocialiteController extends Controller
{
    /**
     * @var Socialite
     */
    protected $socialite;

    /**
     * @var SocialiteUser
     */
    protected $service;

    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * SocialiteController constructor.
     * @param Socialite $socialite
     * @param UserRepository $userRepository
     * @param SocialiteUser $socialiteUser
     */
    public function __construct(
        Socialite $socialite,
        UserRepository $userRepository,
        SocialiteUser $socialiteUser
    )
    {
        $this->socialite = $socialite;
        $this->users = $userRepository;
        $this->service = $socialiteUser;
        $this->middleware((new AuthController)->guestMiddleware());
    }

    /**
     * Redirect to social provider.
     *
     * @param $provider
     * @return mixed
     */
    public function getSocialAuth($provider)
    {
        return $this->socialite->driver($provider)->scopes([
            'email'
        ])->redirect();
    }

    /**
     * Email form.
     *
     * @param GetEmailFormRequest $request
     * @param $provider
     * @param $social
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmailForm(GetEmailFormRequest $request, $provider, $social)
    {
        return view('auth.email', ['social' => $social]);
    }

    public function postEmailForm(
        SocialiteUserSaveEmailRequest $request,
        $provider,
        $social
    )
    {
        $callback = json_decode($social->callback);
        $this->service->init($provider, $callback);
        list($frst_n, $last_n) = $this->service->getFirstAndLustNames($callback->name);
        $user = $this->users->createSimpleUser([
            'email'     => $request->get('email'),
            'password'  => $this->users->hashPassword(str_random(45)),
            'firstname' => $frst_n,
            'lastname'  => $last_n
        ], (int)true);
        $this->service->tryToAssociateUser($social, $request->get('email'));

        $this->service->login($user);

        $this->service->avatar($callback->avatar);

        return redirect()->route('home')->withStatus('Logged in success.')->withColor('green');;
    }

    /**
     * Social provider callback.
     *
     * @param $provider
     * @return string
     */
    public function getSocialAuthCallback($provider)
    {
        if ($s_user = $this->getProvidedUser($provider)) {
            $user = $this->service
                ->init($provider, $s_user)
                ->register();
            if ($user instanceof SocialiteUser) {
                return redirect()->route('social_auth_email', [
                    'provider' => $user->getProvider(),
                    'social' => $user->getUser()->getId()
                ]);
            } elseif ($user instanceof User) {
                $this->service->login($user);
                if(! $user->checkAvatar())
                    $this->service->avatar($s_user->getAvatar());
                return redirect()->route('home');
            }

        } else {
            return redirect()->route('login')->withStatus('Something wrong. Try the default register.')->withColor('green');
        }
    }

    /**
     * @param $provider
     * @return \Laravel\Socialite\Contracts\User
     */
    private function getProvidedUser($provider)
    {
        return @$this->socialite->driver($provider)->user();
    }
}