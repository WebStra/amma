<?php

namespace App\Traits;

use App\Image;

trait HasImages
{
    /**
     * Instance images
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}