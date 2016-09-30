<?php

namespace App;

use App\Libraries\Metaable\HasMeta;
use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\ProductPresenter;
use App\Traits\ActivateableTrait;
use App\Traits\HasImages;
use Cviebrock\EloquentTaggable\Taggable;
use Keyhunter\Administrator\Repository;
use App\Libraries\Taggable\TagService;
use Illuminate\Database\Eloquent\Builder;

class Product extends Repository
{
    use ActivateableTrait, Presenterable, HasMeta, HasImages, Taggable;

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

    public function subcategory()
    {
        return $this->hasOne(SubCategory::class, 'id', 'sub_category_id');
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

    /**
     * Get a collection of all Tags a Model has.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable', 'taggable_taggables')
            ->withTimestamps();
    }

    /**
     * Scope for a Model that has all of the given tags.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $tags
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAllTags(Builder $query, $tags)
    {
        $normalized = app(TagService::class)->buildTagArrayNormalized($tags);

        return $query->has('tags', '=', count($normalized), 'and', function (Builder $q) use ($normalized) {
            $q->whereIn('normalized', $normalized);
        });
    }
}