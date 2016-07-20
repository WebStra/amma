<?php

namespace App\Repositories;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Socialite;

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
     * Get user by provider id.
     *
     * @param $provider
     * @param $id
     * @return null
     */
    public function getUserByProvider($provider, $id)
    {
        $model = self::getModel();

        switch ($provider)
        {
            case $model::PROVIDER_FACEBOOK :
                return $this->getFacebookUserById($id);
                break;

            case $model::PROVIDER_GOOGLE :
                return $this->getGoogleUserById($id);
                break;

            default :
                return null;
        }
    }

    /**
     * Get facebook user.
     *
     * @param $id
     * @return mixed
     */
    public function getFacebookUserById($id)
    {
        return $this->getModel()
            ->facebook()
            ->where('provider_id', $id)
            ->first();
    }

    /**
     * Get google user.
     *
     * @param $id
     * @return mixed
     */
    public function getGoogleUserById($id)
    {
        return $this->getModel()
            ->google()
            ->where('provider_id', $id)
            ->first();
    }

    public function createEmpty($provider, ProviderUser $user)
    {
        return self::getModel()
            ->create([
                'provider' => $provider,
                'provider_id' => $user->getId(),
                'callback' => $this->cleanCallback($user),
                'active' => 1
            ]);
    }

    /**
     * Check if user exists.
     *
     * @param $provider
     * @param $id
     * @return bool
     */
    public function checkProviderUser($provider, $id)
    {
        return (bool) $this->getUserByProvider($provider, $id);
    }

    /**
     * Callback to json.
     *
     * @param $callback
     * @return string
     */
    private function cleanCallback($callback)
    {
        $array_callback = (array) $callback;
        $user           = $array_callback['user'];
        unset($array_callback['user']);
        return json_encode(array_merge($array_callback, $user));
    }
}