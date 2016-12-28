<?php

namespace App\Repositories;

use App\RecoverPassword;
use Auth;

class RecoverPasswordRepository extends Repository
{
    /**
     * @return
     */
    public function getModel()
    {
        return new RecoverPassword();
    }

    public function checkUser($email)
    {
        $model = $this->getByEmail($email);
        return (bool) $model;
    }

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
            ->first();
    }

}