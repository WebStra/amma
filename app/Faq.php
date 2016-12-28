<?php

namespace App;

use App\Traits\ActivateableTrait;
use App\Traits\RankedableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;

class Faq extends Repository
{
    use HasTranslations, ActivateableTrait, RankedableTrait;

    /**
     * @var FaqTranslations
     */
    public $translationModel = FaqTranslations::class;

    /**
     * @var string
     */
    protected $table = 'faq';

    /**
     * @var array
     */
    protected $fillable = ['active', 'rank'];

    /**
     * @var array
     */
    public $translatedAttributes = ['title', 'body'];

}