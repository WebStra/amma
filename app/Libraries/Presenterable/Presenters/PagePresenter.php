<?php

namespace App\Libraries\Presenterable\Presenters;

class PagePresenter extends Presenter
{
    /**
     * Render page title.
     *
     * @param string $funcname
     * @return mixed
     */
    public function renderTitle($funcname = "strtoupper")
    {
        return call_user_func($funcname, $this->model->title);
    }
}