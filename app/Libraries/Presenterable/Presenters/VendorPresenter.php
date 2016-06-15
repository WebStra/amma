<?php

namespace App\Libraries\Presenterable\Presenters;

class VendorPresenter extends Presenter
{
    /**
     * Render vendor's title
     *
     * @return string
     */
    public function renderTitle()
    {
        return ucfirst($this->model->name);
    }
}