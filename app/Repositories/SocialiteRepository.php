<?php

namespace App\Repositories;

use App\Socialite;
use Laravel\Socialite\Contracts\User;
use Mockery\CountValidator\Exception;

class SocialiteRepository extends Repository
{
    /**
     * @return Socialite
     */
    public function getModel()
    {
        return new Socialite();
    }

    /**
     * @param $provider
     * @param User $user
     */
    public function register($provider, User $user)
    {
        dd($provider, $user);
    }

    /**
     * @param $name
     * @param array $args
     */
    public function __call($name, array $args)
    {
        list($method, $provider) = explode('register', $name);

        if(! empty($provider))
        {
            return $this->register(strtolower($provider), $args[0]);
        }

        throw new Exception('Undefined method '.$name);
    }
}