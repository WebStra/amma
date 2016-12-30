<?php

namespace App\Http\ViewComposers;


use Illuminate\Contracts\View\View;
use File;

class CurrencyComposer extends Composer
{


    public function compose(View $view)
    {
        $currency = json_decode(File::get(storage_path('app/json_currency.json')));

        return $view->with(['euro'=>$currency->EUR,'usd'=>$currency->USD,'eur'=>$currency->EUR,]);
    }
}