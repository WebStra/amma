<?php

namespace App\Traits;

trait HasImagesPresentable
{
    /**
     * Get image where type is cover.
     *
     * @param $size
     * @param $default
     * @return string
     */
    public function cover($size = null, $default = null, $order = 'asc')
    {
        $image = $this->model->images()->ranked($order)->cover()->first();

        $default = !is_null($default) ? $default : '';

        return $image ? $image->present()->image($size) : $default;
    }
}