<?php

namespace App\Libraries\Categoryable;

use App\Category;
use App\Libraries\Taggable\TagService;
use App\Tag;
use App\Traits\ActivateableTrait;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Keyhunter\Administrator\Repository as Eloquent;

class Categoryable extends Eloquent
{
    use ActivateableTrait, Taggable;

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
     * Get by instance scope.
     *
     * @param $query
     * @param $type
     *
     * @return mixed
     */
    public function scopeElementType($query, $type)
    {
        if($type instanceof \Closure)
            return $query->$type();

        if($type instanceof Model)
            return $query->where('categoryable_type', get_class($type));

        return $query->where('categoryable_type', $type);
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