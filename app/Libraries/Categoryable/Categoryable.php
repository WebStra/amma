<?php

namespace App\Libraries\Categoryable;

use App\Category;
use App\Product;
use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository as Eloquent;

class Categoryable extends Eloquent
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'categoryable';

    /**
     * @var array
     */
    protected $fillable = ['categoryable_id', 'categoryable_type', 'category_id', 'type', 'active'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function categoryable()
    {
        return $this->morphTo();
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

    /**
     * Get product scope.
     *
     * @param $query
     * @return mixed
     */
    public function scopeProducts($query)
    {
        return $query->where('categoryable_type', Product::class);
    }

    /**
     * Get subcategory scope.
     *
     * @param $query
     * @return mixed
     */
    public function scopeSubcategories($query)
    {
        return $query->where('categoryable_type', Category::class);
    }
}