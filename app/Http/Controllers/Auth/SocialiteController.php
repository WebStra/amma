<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\GetEmailFormRequest;
use App\Http\Requests\Request;
use App\Http\Requests\SocialiteUserSaveEmailRequest;
use App\Repositories\UserRepository;
use App\Services\SocialiteUser;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Contracts\User as ProviderUser;

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
     */
    public function __construct(Socialite $socialite, UserRepository $userRepository)
    {
        $this->socialite = $socialite;
        $this->users = $userRepository;
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
        list($frst_n, $last_n) = explode(' ', $callback->name);

        $user = $this->users->createSimpleUser([
            'email' => $request->get('email'),
            'password' => $this->users->hashPassword(str_random(45)),
            'first_name' => $frst_n,
            'last_name' => $last_n
        ], (int) true);
    }

    /**
     * Social provider callback.
     *
     * @param $provider
     * @return string
     */
    public function getSocialAuthCallback($provider)
    {
        if($user = $this->getProvidedUser($provider)){
            $user = $this
                ->initSocialUserService($provider, $user)
                ->register();

            if($user instanceof SocialiteUser)
                return redirect()->route('social_auth_email', [
                    'provider' => $user->getProvider(),
                    'social' => $user->getUser()->getId()
                ]);

            // login the user ..
        }else{
            return redirect()->route('login')->withStatus('Something wrong. Try the default register.');
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

    /**
     * Init social user service.
     *
     * @param $provider
     * @param ProviderUser $user
     * @return SocialiteUser
     */
    private function initSocialUserService($provider, ProviderUser $user)
    {
        return $this->service = (new SocialiteUser($provider, $user))
            ->setProvider($provider)
            ->setUser($user);
    }

    public function loginUser($user)
    {
        //
    }
}