<?php

namespace App\Libraries\Categoryable;

use App\Category;
use App\Traits\ActivateableTrait;
use Illuminate\Database\Eloquent\Model;
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
}