<?php

namespace App\Libraries\Presenterable\Presenters;

class TagPresenter extends Presenter
{
    /**
     * Generate dynamic filter name.
     *
     * @return string
     */
    public function generateDynamicFilterName()
    {
        return sprintf("%s_%s", strtolower($this->model->group), $this->model->name);
    }
}