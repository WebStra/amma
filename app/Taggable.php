<?php

namespace App;

use Keyhunter\Administrator\Repository;

class Taggable extends Repository
{
    /**
     * @var string
     */
    protected $table = 'taggable_taggables';

    /**
     * @var array
     */
    protected $fillable = [ 'tag_id', 'taggable_id', 'taggable_type' ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function taggable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tag()
    {
        return $this->hasOne(Tag::class, 'id', 'tag_id');
    }

    /**
     * Scope get by element.
     *
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeElementType($query, $type)
    {
        return $query->where('taggable_type', $type);
    }
}