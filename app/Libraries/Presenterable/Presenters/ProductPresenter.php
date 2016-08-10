<?php

namespace App\Libraries\Presenterable\Presenters;

use App\Libraries\Presenterable\ImagePresentorPresentable;
use Carbon\Carbon;

class ProductPresenter extends Presenter
{
    use ImagePresentorPresentable;
    
    /** Expiration date field. */
    const END_DATE = 'expiration_date';

    /**
     * Render product's name in uppercase.
     *
     * @return string
     */
    public function renderName()
    {
        return strtoupper($this->model->name);
    }

    /**
     * Render name only with first character uppercase.
     *
     * @return string
     */
    public function renderNameSimple()
    {
        return ucfirst($this->model->name);
    }

    /**
     * Render product's price.
     *
     * @param $price. Should be reformated.
     * @return string
     */
    public function renderPrice($price = null)
    {
        if(! isset($price)) {
            $price = $this->reformatPrice($this->model->price);
        }

        return sprintf("%s MDL", $price);
    }

    /**
     * Render price with calc. sale..
     *
     * @param $onlyPrice
     * @return string
     */
    public function renderPriceWithSale($onlyPrice = false)
    {
        $price = $this->reformatPrice($this->model->price - $this->getPriceAmountSale());
//        $price = $this->getPriceAmountSale();
        if($onlyPrice)
            return ($price != 0) ? $price : '';

        return sprintf('%s MDL', $price);
    }

    public function getSaledPrice()
    {
        return number_format($this->model->price - $this->getPriceAmountSale());
    }

    /**
     * Calculate price amount sale.
     *
     * @return string
     */
    public function getPriceAmountSale()
    {
        return $this->model->sale * $this->model->price / 100;
    }

    /**
     * Reformat price.
     *
     * @param $price
     * @return string
     */
    public function reformatPrice($price)
    {
        return number_format($price, 0, ',', ' ');
    }

    /**
     * Render economy price.
     * - rest from sale.
     *
     * @return string
     */
    public function economyPrice()
    {
        return $this->renderPrice($this->reformatPrice($this->getPriceAmountSale()));
    }

    /**
     * Render sale of product.
     *
     * @return string
     */
    public function renderSale()
    {
        return sprintf('%s%%', number_format($this->model->sale));
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

        return $this->model->$enddate->format($format);
    }

    /**
     * Calc. difference from (expiration_date and today),
     * end_date MUST be bigger than now date.
     *
     * @return \DateInterval
     */
    public function diffEndDate()
    {
        $enddate = self::END_DATE;

        return $this->model->$enddate->diff(Carbon::now());
    }

    public function getTotalSumm()
    {
        return number_format($this->getSaledPrice() * $this->model->count);
    }

    public function getSalesSumm()
    {
        $involveds = $this->model->involved()->active()->get();

        $totalSalesSumm = 0;

        $involveds->each(function ($involved) use (&$totalSalesSumm) {
            $price = $this->getSaledPrice() * $involved->count;

            $totalSalesSumm += $price;
        });

        return $totalSalesSumm;
    }

    /**
     * @param bool $rotate
     * @return float|string
     */
    public function getSalesPercent($rotate = true)
    {   
        if($this->getSalesSumm()) {
        $result = ($this->getSalesSumm() * 100) / $this->getTotalSumm();
        }
        else {
            $result=0;
        }
        if($rotate)
            return number_format(round(number_format($result)));
        
        return $result;
    }

    public function getSale($showPercent = false)
    {
        $sale = $this->model->sale;
        
        if(empty($sale) && $sale == 0)
            $sale = 0;

        if($showPercent)
            return sprintf('%s%%', $sale);

        return $sale;
    }

    public function renderInvolvedPriceSumm($count)
    {
        $summ = $this->model->price * $count;
        
        return $this->renderPrice($summ);
    }

    public function getInfoLabel()
    {
        return '';
    }
}