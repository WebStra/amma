<?php

namespace App;

use App\Libraries\Categoryable\Categoryable;
use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\CategoryPresenter;
use App\Traits\ActivateableTrait;
use App\Traits\Categories\HasFilters;
use App\Traits\HasImages;
use App\Traits\RankedableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;

class Category extends Repository
{
    use HasTranslations,
        ActivateableTrait,
        RankedableTrait,
        HasImages,
        Presenterable,
        HasFilters;

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var CategoryPresenter
     */
    protected $presenter = CategoryPresenter::class;

    /**
     * @var CategoryTranslation
     */
    public $translationModel = CategoryTranslation::class;

    /**
     * @var array
     */
    protected $fillable = ['tax', 'active', 'show_in_footer', 'show_in_sidebar', 'rank'];

    /**
     * @var array
     */
    public $translatedAttributes = ['name', 'slug', 'seo_title', 'seo_description', 'seo_keywords'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryables()
    {
        return $this->hasMany(Categoryable::class, 'id', 'category_id');
    }
}