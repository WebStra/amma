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

    /**
     * Get image where type is cover.
     *
     * @return string
     */
    public function scopeCover()
    {
        $image = $this->images()->cover()->first();

        return $image ? $image->image : '';
    }
}