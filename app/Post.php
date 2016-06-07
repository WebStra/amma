<?php

namespace App;

use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;

class Post extends Repository
{
    use HasTranslations;

    protected $fillable = ['*'];

    public $translatedAttributes = ['name'];
}