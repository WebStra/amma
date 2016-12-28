<?php

namespace App\Libraries\Presenterable\Presenters;

use App\Traits\HasImagesPresentable;
use Carbon\Carbon;
use File;

class ProductPresenter extends Presenter
{
    use HasImagesPresentable;

    const END_DATE = 'expire_date';
    const PRICE_EMPTY = '0.00';

    /**
     * Render product's name in uppercase.
     *
     * @return string
     */
    public function renderName()
    {
        if($this->model->name)
            return strtoupper($this->model->name);

        return $this->renderDraftedName();
    }

    public function renderDraftedName()
    {
        if($lot = $this->model->lot)
            return sprintf('Drafted #%s product %s', $lot->id, $this->model->id);

        return sprintf('#tempname%s', str_random(9));
    }

    public function renderNameSimple()
    {
        return ucfirst($this->model->name);
    }

    public function renderCountItem()
    {
            return strtoupper($this->model->count);

    }

    public function renderPrice($price = null, $currency = null)
    {
        return sprintf("%s %s", ($price) ? $price : self::PRICE_EMPTY, ($currency) ? $currency : '');
    }

    public function renderNewPrice() {

        if($price = $this->model->price) {
            return $price;
        }

        return self::PRICE_EMPTY;
    }

    public function renderOldPrice()
    {
        if($price = $this->model->specPrice->first()->old_price) {
            $currency = $this->renderCurrency();
            return sprintf('%s %s', $price,$currency);
        }

        return self::PRICE_EMPTY;
    }

    public function renderCurrency($inst = 'title')
    {
        if($lot = $this->model->lot)
        {
            if($currency = $lot->currency)
                return $currency->$inst;
        }

        return '';
    }

    /**
     * Calculate price amount sale.
     *
     * @return string
     */
    public function renderSalePercent()
    {
        if($this->model->price && $this->model->old_price)
            return round((($this->model->old_price - $this->model->price) / ($this->model->old_price)) * 100);

        return 0;
    }

    /**
     * Render price with calc. sale..
     *
     * @param $onlyPrice
     * @return string
     */
   /* public function renderPriceWithSale($onlyPrice = false)
    {
        $price = $this->reformatPrice($this->model->price - $this->getPriceAmountSale());
//        $price = $this->getPriceAmountSale();
        $currency = $this->renderCurrency();
        if($onlyPrice)
            return ($price != 0) ? $price : '';

        return sprintf('%s %s', $price,$currency);
    }*/

    public function renderPriceWithSale($onlyPrice = false)
    {
        $price = $this->reformatPrice($this->model->specPrice->first()->new_price);
        $currency = $this->renderCurrency();
        if($onlyPrice)
            return ($price != 0) ? $price : '';

        return sprintf('%s %s', ($price) ? $price : '', $currency);
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
        $currency = $this->renderCurrency();
        $economy = $this->renderPrice($this->reformatPrice($this->getPriceAmountSale()));

        return sprintf('%s%s',$economy,$currency);
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
        if ($this->model->count) {
            $number = $this->getSaledPrice() * $this->model->count;
        }else{
            $number = $this->getSaledPrice();
        }
        return number_format($number);
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
        if($this->getSalesSumm() != 0) {
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

    public function convertAmount($item) {

        $currency = json_decode(File::get(storage_path('app/json_currency.json')));

        $money = ['euro'=>$currency->EUR,'usd'=>$currency->USD];

        if($item->lot->currency_id == 1){
            return round($item->specPrice->first()->new_price * $money['usd']);
        }
        elseif($item->lot->currency_id == 2) {
            return round($item->specPrice->first()->new_price * $money['euro']);
        }
        else {
            return '';
        }

    }


    public function getInfoLabel()
    {
        return '';
    }
}