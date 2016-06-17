<?php

namespace App\Libraries\Presenterable\Presenters;

use App\Traits\HasImagesPresentable;

class VendorPresenter extends Presenter
{
    use HasImagesPresentable;
    
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