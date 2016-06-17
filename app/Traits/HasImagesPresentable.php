<?php

namespace App\Traits;

trait HasImagesPresentable
{
    /**
     * Get image where type is cover.
     *
     * @param $default
     * @return string
     */
    public function cover($default = null)
    {
        $image = $this->model->images()->cover()->first();

        $default = !is_null($default) ? $default : '';

        return $image ? $image->image : $default;
    }
}