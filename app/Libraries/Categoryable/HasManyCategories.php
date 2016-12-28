<?php

namespace App\Libraries\Categoryable;

trait HasManyCategories
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function categories()
    {
        return $this->morphMany(Categoryable::class, 'categoryable');
    }
}