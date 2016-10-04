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

    /**
     * @return string
     */
    public function cover($size = null, $default)
    {
        $images = $this->model->images;

        if(count($images))
        {
            return $images->first()->present()->cover($size, $default);
        }

        return $default;
    }

    public function renderPrice($price, $currency)
    {
        //
    }

    public function renderNewPrice()
    {
        return '';
    }

    public function renderOldPrice()
    {

    }

    public function renderCurrency()
    {

    }

    public function renderSalePercent()
    {
        //
    }
}