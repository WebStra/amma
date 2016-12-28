<?php

namespace App\Traits;

trait Confirmed
{
    /**
     * Confirmed.
     *
     * @param $query
     * @return mixed
     */
    public function scopeConfirmed($query)
    {
        return $query->whereConfirmed(1);
    }
}