<?php

namespace App\Repositories;

use App\Faq;
use App\FaqTranslations;

class FaqRepository extends Repository
{
    /**
     * @return Faq
     */
    public function getModel()
    {
        return new Faq();
    }

    /**
     * @return FaqTranslations
     */
    public function getTranslatableModel()
    {
        return new FaqTranslations();
    }

    /**
     * Get public faq.
     *
     * @return mixed
     */
    public function getPublic()
    {
        return self::getModel()
            ->active()
            ->ranked()
            ->get();
    }
}