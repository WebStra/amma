<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Socialite;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Mockery\CountValidator\Exception;
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
     * @param $provider
     * @param ProviderUser $user
     */
    public function __construct($provider, ProviderUser $user)
    {
        $this->setUser($user);
        $this->setProvider($provider);
        $this->socialRepository = $this->getSocialiteRepository();
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
     * @param ProviderUser $user
     * @return $this
     */
    public function setUser(ProviderUser $user)
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
     * @return mixed
     */
    private function associateSocialiteUser($account)
    {
        $user = $this->getUserRepository()->getByEmail($this->user()->getEmail());
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
    private function tryToAssociateUser($social)
    {
        if($this->getUserRepository()->checkIfUserExists($this->user()->getEmail()))
            return $this->associateSocialiteUser($social);

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
            'first_name' => @$names[0],
            'last_name' => @$names[1]
        ]);
    }

    /**
     * @return array
     */
    public function getFirstAndLustNames()
    {
        return explode(' ', $this->user()->getName());
    }
}