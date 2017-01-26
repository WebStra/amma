<?php

namespace App\Libraries\Presenterable\Presenters;

use App\Traits\HasImagesPresentable;
use Carbon\Carbon;
use File;

/**
 * Class ProductPresenter
 * @package App\Libraries\Presenterable\Presenters
 */
class ProductPresenter extends Presenter
{
    use HasImagesPresentable;

    /**
     *
     */
    const END_DATE = 'expire_date';
    /**
     *
     */
    const PRICE_EMPTY = '0.00';

    /**
     * Render product's name in uppercase.
     *
     * @return string
     */
    public function renderName()
    {
        if (isset($this->model->name))
            return strtoupper(str_limit($this->model->name, $limit = 35, $end = '..'));

        return $this->renderDraftedName();
    }

    /**
     * @return string
     */
    public function renderDraftedName()
    {
        if ($lot = $this->model->lot)
            return sprintf('Drafted #%s product %s', $lot->id, $this->model->id);

        return sprintf('#tempname%s', str_random(9));
    }

    /**
     * @return string
     */
    public function renderNameSimple()
    {
        return ucfirst($this->model->name);
    }

    /**
     * @return string
     */
    public function renderCountItem()
    {
        $amount = '-';
        if (isset($this->model->specPrice->first()->improvedSpecs))
            if (count($this->model->specPrice->first()->improvedSpecs()->get()) > 0){
                $color = $this->model->specPrice->first()->improvedSpecs()->first()->specColors()->first();
                if($color){
                    $amount = $color->amount;
                }
            }

       return $amount;
    }

    /**
     * @param string $inst
     * @return string
     */
    public function renderCurrency($inst = 'title')
    {
        if ($lot = $this->model->lot) {
            if ($currency = $lot->currency)
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
        if (isset($this->model->specPrice->first()->sale))
            return round($this->model->specPrice->first()->sale, 2);

        return 0;
    }


    /**
     * @return string
     */
    public function renderOldPrice()
    {
        if (isset($this->model->specPrice->first()->old_price)) {
            $price = $this->model->specPrice->first()->old_price;
            $currency = $this->renderCurrency();
            return sprintf('%s %s', $price, $currency);
        }
        return self::PRICE_EMPTY;
    }


    /**
     * @param bool $onlyPrice
     * @return string
     */
    public function renderPriceWithSale($onlyPrice = false)
    {
        if (isset($this->model->specPrice->first()->new_price)) {
            $price = $this->reformatPrice($this->model->specPrice->first()->new_price);
            $currency = $this->renderCurrency();
            if ($onlyPrice)
                return ($price != 0) ? $price : '';

            return sprintf('%s %s', ($price) ? $price : '', $currency);
        }
        return self::PRICE_EMPTY;
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


    /**
     * @return int
     */
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

    public function economyPrice()
    {

        $economy = $this->model->specPrice->first()->old_price - $this->model->specPrice->first()->new_price;

        return $economy;

    }


    /**
     * @param $item
     * @return float|string
     */
    public function convertAmount()
    {
        $currency = json_decode(File::get(storage_path('app/json_currency.json')));
        $money = ['euro' => $currency->EUR, 'usd' => $currency->USD];
        if (isset($this->model->specPrice) && count($this->model->specPrice) > 0) {
            if ($this->model->lot->currency_id == 1) {
                return round($this->model->specPrice->first()->new_price * $money['usd']);
            } elseif ($this->model->lot->currency_id == 2) {
                return round($this->model->specPrice->first()->new_price * $money['euro']);
            } else {
                return '';
            }
        } else {
            return '0';
        }

    }


    /**
     * @return string
     */
    public function getInfoLabel()
    {
        return '';
    }
}