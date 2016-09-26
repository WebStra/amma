<?php

namespace App;

use App\Libraries\Categoryable\HasCategory;
use App\Libraries\Metaable\HasMeta;
use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\ProductPresenter;
use App\Traits\ActivateableTrait;
use App\Traits\HasImages;
use Keyhunter\Administrator\Repository;

class Product extends Repository
{
    use ActivateableTrait, Presenterable, HasMeta, HasImages;
    
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var ProductPresenter
     */
    protected $presenter = ProductPresenter::class;

    /**
     * @var array
     */
    protected $fillable = [
        'sub_category_id',
        'lot_id',
        'name',
        'featured',
        'price',
        'old_price',
        'sale',
        'count',
        'active',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function colors()
    {
        return $this->hasMany(ProductsColors::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lot()
    {
        return $this->belongsTo(Lot::class, 'lot_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function involved()
    {
        return $this->hasMany(Involved::class);
    }

    /**
     * Drafted products scope.
     *
     * @param $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeDrafted($query)
    {
        return $query->whereStatus('drafted');
    }

    /**
     * Published products scope.
     *
     * @param $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereStatus('published');
    }

    /**
     * Completed products scope.
     *
     * @param $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->whereStatus('completed');
    }

    /**
     * Featured products scope.
     *
     * @param $query
     * @return mixed
     */
    public function scopeFeatured($query)
    {
        return $query->whereFeatured(1);
    }
}