<?php

namespace App\Repositories;

use App\Subscribe;
use Auth;

class SubscribeRepository extends Repository
{
    /**
     * @return 
     */
    public function getModel()
    {
        return new Subscribe();
    }

    /**
     * @param array $data
     * @return Subscribe
     */
    public function sendSubscribe(array $data) 
    {
        return self::getModel()
            ->create([
	        'email'  => $data['email'],
	        'token'  => str_random(30),
        ]);
    }

    public function checkSubscriber($email)
    {
        $model = $this->getByEmail($email);

	       return (bool) $model;
    }

    /**
     * @param $email
     * @return Subscribe
     */
    public function getByEmail($email)
    {
        return self::getModel()
            ->whereEmail($email)
            ->first();
    }

    public function getByToken($token)
    {
        return self::getModel()
            ->where('token', $token)
            ->active()
            ->first();
    }

    public function unscribe(Subscribe $model)
    {
        $model->active = (int) false;

        $model->save();
    }
}