<?php

namespace App\Traits\Categories;

use App\CategoryFilter;

trait HasFilters
{
    /**
     * Get filters.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function filters()
    {
        return $this->morphMany(CategoryFilter::class, 'filterable');
    }
}