<?php

namespace App;

use App\Traits\ActivateableTrait;
use App\Traits\HasImages;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;

class SubCategory extends Repository implements Translatable
{
    use ActivateableTrait, HasTranslations, HasImages;

    /**
     * @var string
     */
    protected $table = 'sub_categories';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'active'];

    /**
     * @var SubCategoryTranslations
     */
    public $translationModel = SubCategoryTranslations::class;

    /**
     * @var array
     */
    public $translatedAttributes = ['name', 'slug', 'seo_title', 'seo_description', 'seo_keywords'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
