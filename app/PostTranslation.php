<?php

namespace App;

use App\Libraries\WithoutTimestampsModel;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class PostTranslation extends WithoutTimestampsModel implements SluggableInterface
{
    use SluggableTrait;

    /**
     * @var string
     */
    protected $table = 'post_translations';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    /**
     * @var array
     */
    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug'
    );
}