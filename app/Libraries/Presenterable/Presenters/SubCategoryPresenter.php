<?php

namespace App\Libraries\Presenterable\Presenters;

class SubCategoryPresenter extends Presenter
{
    /**
     * Render name.
     *
     * @param bool $upper
     * @return mixed|string
     */
    public function renderName($upper = false)
    {
        $name = $this->model->name;

        if($upper)
            return strtoupper($name);

        return $name;
    }
}