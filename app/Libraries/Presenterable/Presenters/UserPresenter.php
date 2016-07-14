<?php

namespace App\Libraries\Presenterable\Presenters;

use App\Libraries\Presenterable\ImagePresentorPresentable;

class UserPresenter extends Presenter
{
	use ImagePresentorPresentable;

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