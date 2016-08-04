<?php

namespace App\Listeners;

use App\Events\PaymentProductsCreate;

class ProductCreateWithdrawal
{
    /**
     * Handle the event.
     *
     * @param  PaymentProductsCreate  $event
     * @return void
     */
    public function handle(PaymentProductsCreate $event)
    {
        $user    = $event->getUser();
        $product = $event->getProduct();
    }
}