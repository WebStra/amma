<?php

namespace App;

use App\Libraries\WithoutTimestampsModel;

class FaqTranslations extends WithoutTimestampsModel
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