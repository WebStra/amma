<?php

namespace App;

use Keyhunter\Administrator\Repository;

class Image extends Repository
{
    /**
     * @var array
     */
    protected $fillable = ['type', 'original', 'image', 'imageable_type', 'imageable_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Scope cover image.
     *
     * @param $query
     * @return mixed
     */
    public function scopeCover($query)
    {
        return $query->whereType('cover');
    }
}