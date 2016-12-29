<?php

namespace App\Libraries\Presenterable\Presenters;

use App\Traits\HasImagesPresentable;
use App\Traits\LikeablePresentorTrait;
use Carbon\Carbon;

class VendorPresenter extends Presenter
{
    use HasImagesPresentable, LikeablePresentorTrait;

    /**
     * Render vendor's title
     *
     * @return string
     */
    public function renderTitle()
    {
        return ucfirst($this->model->name);
    }

    /**
     * @return int
     */

    /**
     * @return int
     */
    public function totalCount()
    {
        return count($this->model->products);
    }
}