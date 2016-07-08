<?php

namespace App;

use App\Libraries\Categoryable\CategoryableTrait;
use App\Libraries\Metaable\HasMeta;
use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\ProductPresenter;
use App\Traits\ActivateableTrait;
use App\Traits\HasImages;
use Keyhunter\Administrator\Repository;

class Product extends Repository
{
    use CategoryableTrait, ActivateableTrait, Presenterable, HasMeta, HasImages;
    
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
    protected $dates = ['expiration_date', 'published_date'];

    /**
     * @var array
     */
    protected $fillable = [
        'vendor_id',
        'name',
        'featured',
        'price',
        'sale',
        'count',
        'type',
        'status',
        'published_date',
        'expiration_date',
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
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get user through vendor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->vendor->user();
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
}