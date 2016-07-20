<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Socialite;
use Auth;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Repositories\SocialiteRepository;

class SocialiteUser
{
    /**
     * @var ProviderUser
     */
    private $user;

    /**
     * @var string
     */
    private $provider;

    /**
     * SocialiteUser constructor.
     */
    public function __construct()
    {
        $this->socialRepository = $this->getSocialiteRepository();
    }

    /**
     * @param $provider
     * @param $callback
     * @return $this
     */
    public function init($provider, $callback)
    {
        $this
            ->setProvider($provider)
            ->setUser($callback);

        return $this;
    }

    /**
     * Register.
     *
     * @return mixed|null
     */
    public function register()
    {
        if ($this->socialRepository->checkProviderUser($this->getProvider(), $this->user()->getId()))
        {
            $s_user = $this->socialRepository->getUserByProvider(
                $this->getProvider(), $this->user()->getId()
            );

            if($s_user->user)
                return $s_user;

            return $this;
        }

        $social = $this->getOrCreateEmptySocialUser();

        if($this->checkEmail())
            return $this->createSocialUserWithEmail($social);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @return ProviderUser
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user.
     *
     * @param $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set provider.
     *
     * @param $provider
     * @return $this
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return ProviderUser
     */
    protected function user()
    {
        return $this->getUser();
    }

    /**
     * Get or create social user
     *
     * @return null|static
     */
    protected function getOrCreateEmptySocialUser()
    {
        if($this->socialRepository->checkProviderUser($this->getProvider(), $this->user()->getId()))
            return $this->socialRepository->getUserByProvider($this->getProvider(), $this->user()->getId());

        return $this->socialRepository->createEmpty(
            $this->getProvider(), $this->user()
        );
    }

    /**
     * @return SocialiteRepository
     */
    private function getSocialiteRepository()
    {
        return new SocialiteRepository();
    }

    /**
     * @return UserRepository
     */
    private function getUserRepository()
    {
        return new UserRepository();
    }

    /**
     * Associate user.
     *
     * @param $account
     * @param null $email
     * @return mixed
     */
    private function associateSocialiteUser($account, $email = null)
    {
        if(! $email)
            $email = $this->user()->getEmail();

        $user = $this->getUserRepository()->getByEmail($email);
        $account->user()->associate($user);
        $account->save();

        return $user;
    }

    /**
     * Check if email exists;
     *
     * @return bool
     */
    private function checkEmail()
    {
        return (bool) $this->user()->getEmail();
    }

    /**
     * @param $social
     * @return bool
     */
    public function tryToAssociateUser($social, $email = null)
    {
        if(! $email)
            $email = $this->user()->getEmail();

        if($this->getUserRepository()->checkIfUserExists($email))
            return $this->associateSocialiteUser($social, $email);

        return false;
    }

    /**
     * Create social user.
     *
     * @param Socialite $social
     * @return mixed
     */
    private function createSocialUserWithEmail(Socialite $social)
    {
        $this->tryToAssociateUser($social);
        $names = $this->getFirstAndLustNames();

        return $this->getUserRepository()->create([
            'email' => $this->user()->getEmail(),
            'name' => $this->user()->getName(),
            'password' => $this->users->hashPassword(str_random(45)),
            'firstname' => @$names[0],
            'lastname' => @$names[1]
        ]);
    }

    /**
     * @param null $name
     * @return array
     */
    public function getFirstAndLustNames($name = null)
    {
        if(! $name)
            $name = $this->user()->getName();

        return explode(' ', $name);
    }

    /**
     * Login the user.
     *
     * @param $user
     */
    public function login($user)
    {
        \Auth::login($user, true);
    }

    /**
     * Add avatar.
     *
     * @param $avatar
     * @return $this
     */
    public function avatar($avatar)
    {
        (new ImageProcessor())->changeAvatar($avatar);

        return $this;
    }
}