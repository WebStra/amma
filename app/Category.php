<?php

namespace App;

use App\Libraries\Categoryable\CategoryableTrait;
use App\Libraries\Categoryable\Categoryable;
use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\CategoryPresenter;
use App\Traits\ActivateableTrait;
use App\Traits\HasImages;
use App\Traits\RankedableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;

class Category extends Repository
{
    use HasTranslations, CategoryableTrait, ActivateableTrait, RankedableTrait, HasImages, Presenterable;

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var CategoryPresenter
     */
    protected $presenter = CategoryPresenter::class;

    /**
     * @var array
     */
    protected $fillable = ['tax', 'active', 'show_in_footer', 'show_in_sidebar', 'rank', 'type'];

    /**
     * @var array
     */
    public $translatedAttributes = ['name', 'slug', 'seo_title', 'seo_description', 'seo_keywords'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryables()
    {
        return $this->hasMany(Categoryable::class);
    }
    
    /**
     * Where type parent scope.
     *
     * @param $query
     * @return mixed
     */
    public function scopeParent($query)
    {
        return $query->whereType('parent');
    }

    /**
     * Where type child scope.
     *
     * @param $query
     * @return mixed
     */
    public function scopeChild($query)
    {
        return $query->whereType('child');
    }
}