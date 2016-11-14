<?php

namespace App\Libraries\Presenterable\Presenters;

use Carbon\Carbon;

class LotPresenter extends Presenter
{
    const END_DATE = 'expire_date';

    const PUBLIC_DATE = 'public_date';

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

    /**
     * Render end date from expiration_date timestamp.
     *
     * @param string $format
     * @return mixed
     */
    public function endDate($format = 'm/d/Y')
    {
        $enddate = self::END_DATE;

        $date = $this->model->$enddate;

        if($date)
            return $date->format($format);

        return '';
    }

    /**
     * Calc. difference from (expire day and today),
     * end_date MUST be bigger than now date.
     *
     * @return \DateInterval
     */
    public function diffEndDate()
    {
        $enddate = self::END_DATE;

        $date = $this->model->$enddate;

        if($date)
            return $date->diff(Carbon::now());

        return '';
    }

    /**
     * Get expire date as string.
     *
     * @return string
     */
    public function getExpireDateAsString()
    {
        $enddate = self::END_DATE;

        $date = $this->model->$enddate;

        if($date instanceof Carbon)
        {
            return $date->toDateTimeString();
        }

        return '';
    }

    /**
     * Get expire date as string.
     *
     * @return string
     */
    public function getPublicDateAsString()
    {
        $public_date = self::PUBLIC_DATE;

        $date = $this->model->$public_date;

        if($date instanceof Carbon)
        {
            return $date->toDateTimeString();
        }

        return '';
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