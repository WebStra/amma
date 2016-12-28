<?php

namespace App;

use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\PagePresenter;
use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Model\Page as MainPage;

class Page extends MainPage
{
    use ActivateableTrait, Presenterable;

    /**
     * @var PagePresenter
     */
    public $presenter = PagePresenter::class;

    /**
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'body', 'page_type', 'active', 'show_in_footer', 'show_in_header'
    ];
}