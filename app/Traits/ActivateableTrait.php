<?php

namespace App\Traits;

trait ActivateableTrait
{
    /**
     * Scope where active.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }

    /**
     * Scope where deactive.
     * 
     * @param $query
     * @return mixed
     */
    public function scopeDeactivated($query)
    {
        return $query->whereActive(0);
    }
}