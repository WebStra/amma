<?php

namespace App\Orders;

abstract class Order
{
    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->handle();
    }

    /**
     * Method witch run's on serialize object.
     *
     * @return void.
     */
    abstract public function handle();
}