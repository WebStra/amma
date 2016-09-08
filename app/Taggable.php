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
}