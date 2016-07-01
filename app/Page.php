<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Model\Page as MainPage;

class Page extends MainPage
{
    use ActivateableTrait;

    protected $fillable = [
        'slug', 'title', 'body', 'active', 'show_in_footer', 'show_in_header'
    ];
}