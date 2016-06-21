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
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $fillable = ['categoryable_id', 'categoryable_type', 'category_id', 'active'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function categoryable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
    public function scopeCategories($query)
    {
        return $query->where('categoryable_type', Category::class);
    }
}