<?php

namespace App\Libraries\Categoryable;

trait HasCategory
{
    /**
     * @return mixed
     */
    public function category()
    {
        return $this->morphOne(Categoryable::class, 'categoryable');
    }
}