<?php

namespace App\Libraries\Presenterable;

trait ImagePresentorPresentable
{
    /**
     * Cover image.
     * @to_work: Should use App\Libraries\Presenterable trait.
     *
     * @param string $order
     * @param null $size
     * @return mixed
     */
    public function cover($order = 'asc', $size = null, $default = null)
    {
        $image = $this->model
            ->images()
            ->ranked($order)
            ->first();

        if($image)
            return $image->present()
                ->image($size);

        return '';
    }
}