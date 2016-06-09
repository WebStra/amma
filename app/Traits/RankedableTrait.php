<?php

namespace App\Traits;

trait RankedableTrait
{
    /**
     * Scope order by rank.
     *
     * @param $query
     * @return mixed
     */
    public function scopeRanked($query)
    {
        return $this->orderBy('rank', 'ASC');
    }
}