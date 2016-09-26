<?php

namespace App\Libraries\Presenterable\Presenters;

class LotPresenter extends Presenter
{
    /**
     * Render lot's name...
     *
     * @return string
     */
    public function renderName()
    {
        if(! $this->model->name)
            return $this->renderDraftedName();

        return ucfirst($this->model->name);
    }

    /**
     * Render drafted lot's name..
     *
     * @return string
     */
    public function renderDraftedName()
    {
        return 'Drafted lot #'. $this->model->id;
    }
}