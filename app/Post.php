<?php

namespace App;

use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\PostPresenter;
use App\Traits\ActivateableTrait;
use App\Traits\HasImages;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;

class Post extends Repository
{
    use HasTranslations, ActivateableTrait, Presenterable, HasImages;

    /**
     * @var PostPresenter
     */
    protected $presenter = PostPresenter::class;
    
    /**
     * @var array
     */
    protected $fillable = ['status', 'active', 'view_count'];

    /**
     * @var array
     */
    public $translatedAttributes = [
        'title', 'slug', 'body', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    /**
     * Status is published scope.
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->whereStatus('published');
    }
}