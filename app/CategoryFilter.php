<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;

class CategoryFilter extends Repository implements Translatable
{
    use ActivateableTrait, HasTranslations;

    /**
     * @var string
     */
    protected $table = 'category_filters';

    /**
     * @var array
     */
    protected $fillable = ['filterable_id', 'filterable_type', 'filter_type', 'filter_attributes', 'group', 'active'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var CategoryFilterTranslation
     */
    public $translationModel = CategoryFilterTranslation::class;

    /**
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * Get all of the owning filterable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function filterable()
    {
        return $this->morphTo();
    }
}