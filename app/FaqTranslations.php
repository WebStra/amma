<?php

namespace App;

use App\Libraries\TranslatableModel;

class FaqTranslations extends TranslatableModel
{
    /**
     * @var string
     */
    protected $table = 'faq_translations';

    /**
     * @var array
     */
    protected $fillable = ['language_id', 'faq_id', 'title', 'body'];
}