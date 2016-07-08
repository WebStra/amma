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
    public function cover($order = 'asc', $size = null)
    {
        return $this->model
            ->images()
            ->ranked($order)
            ->first()
            ->present()
            ->image($size);
    }
}