<?php

namespace App\Repositories;

use App\Currency;

class CurrenciesRepository extends Repository
{
    /**
     * @return Currency
     */
    public function getModel()
    {
        return new Currency();
    }

    /**
     * @return mixed
     */
    public function getPublic()
    {
        return self::getModel()
            ->active()
            ->get();
    }
}