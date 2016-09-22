<?php

namespace App\Repositories;

use App\Lot;

class LotRepository extends Repository
{
    /**
     * @return Lot
     */
    public function getModel()
    {
        return new Lot();
    }
}