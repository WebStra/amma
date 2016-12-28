<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;

class Video extends Repository
{
    use HasTranslations, ActivateableTrait;

    /**
     * @var FaqTranslations
     */
    public $translationModel = VideoTranslations::class;

    /**
     * @var string
     */
    protected $table = 'video';

    /**
     * @var array
     */
    protected $fillable = ['active'];

    /**
     * @var array
     */
    public $translatedAttributes = ['video'];

}