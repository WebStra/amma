<?php

namespace App\Libraries\Presenterable\Presenters;

class UserPresenter extends Presenter
{
    /**
     * Render user's name.
     *
     * @return string
     */
    public function renderName()
    {
        return sprintf('%s %s', $this->model->profile->firstname, $this->model->profile->lastname);
    }
}