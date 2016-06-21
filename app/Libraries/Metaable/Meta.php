<?php

namespace App\Libraries\Metaable;

use Keyhunter\Administrator\Repository as KeyhunterRepository;

class Meta extends KeyhunterRepository
{
    /**
     * @var string
     */
    protected $table = 'meta';

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $fillable = [
        'metaable_id', 'metaable_type', 'key', 'value', 'group'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function metaable()
    {
        return $this->morphTo();
    }

    /**
     * Scope meta group.
     *
     * @param $query
     * @param $group
     * @return mixed
     */
    public function scopeGroup($query, $group)
    {
        return $query->whereGroup($group);
    }
}