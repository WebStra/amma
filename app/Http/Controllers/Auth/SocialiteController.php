<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Repositories\SocialiteRepository;
use App\Http\Controllers\Controller;

class SocialiteController extends Controller
{
    /**
     * @var Socialite
     */
    protected $socialite;

    /**
     * @var SocialiteRepository
     */
    protected $socialiteRepository;

    /**
     * SocialiteController constructor.
     * @param Socialite $socialite
     * @param SocialiteRepository $socialiteRepository
     */
    public function __construct(
        Socialite $socialite,
        SocialiteRepository $socialiteRepository
    )
    {
        $this->socialite = $socialite;
        $this->socialiteRepository = $socialiteRepository;
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
            'email', 'user_birthday'
        ])->redirect();
    }

    /**
     * Social provider callback.
     *
     * @param null $provider
     * @return string
     */
    public function getSocialAuthCallback($provider = null)
    {
        if($user = $this->getProvidedUser($provider)){
            $className = get_class($this->socialiteRepository->getModel());
            $s_user    = null;

            switch($provider)
            {
                case $className::PROVIDER_FACEBOOK :
                    $s_user = $this->socialiteRepository->registerFacebook($user);
                    break;
                case $className::PROVIDER_GOOGLE :
                    $s_user = $this->socialiteRepository->registerGoogle($user);
                    break;

            }

            dd($user->getName());
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
}