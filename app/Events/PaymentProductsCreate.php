<?php

namespace App\Events;

use App\Product;
use Illuminate\Queue\SerializesModels;

class PaymentProductsCreate extends Event
{
    use SerializesModels;

    /**
     * @var Product
     */
    protected $product;

    /**
     * PaymentProductsCreate constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->user = \Auth::user();
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}