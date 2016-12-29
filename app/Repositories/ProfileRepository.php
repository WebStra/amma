<?php

namespace App\Repositories;

use App\Profile;
use Auth;

class ProfileRepository extends Repository
{
    /**
     * @return Profile
     */
    public function getModel()
    {
        return new Profile();
    }
    public function create(array $data)
    {
        return self::getModel()
            ->create($data);
    }
}