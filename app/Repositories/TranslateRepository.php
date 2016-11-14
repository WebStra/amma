<?php

namespace App\Repositories;

use App\TranslateTransaltions;
use App\Translate;

class TranslateRepository extends Repository
{
    /**
     * @return Translate
     */
    public function getModel()
    {
        return new Translate();
    }

    public function getTanslateModel()
    {
        return new TranslateTransaltions();
    }

    /**
     * @return mixed
     */
    public function getKey($key)
    {
        return self::getModel()
            ->where('key', $key)
            ->active()
            ->first();
    }
}