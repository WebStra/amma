<?php

namespace App\Repositories;

use App\Social;

class SocialRepository extends Repository
{
    /**
     * @return Social
     */
    public function getModel()
    {
        return new Social();
    }

    /**
     * @return mixed
     */
    public function getFooterList()
    {
        return self::getModel()
            ->active()
            ->get();
    }
}