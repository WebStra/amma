<?php

namespace App\Repositories;

use App\MethodDeliveryPayment;
use App\MethodDeliveryPaymentTranslation;

class MethodDeliveryPaymentRepository extends Repository
{
    /**
     * @return MethodDeliveryPayment
     */
    public function getModel()
    {
        return new MethodDeliveryPayment();
    }

    /**
     * @return MethodDeliveryPaymentTranslation
     */
    public function getTranslatableModel()
    {
        return new MethodDeliveryPaymentTranslation();
    }

    /**
     * Get public posts.
     *
     * @param $perPage
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublic($type)
    {
        return self::getModel()
            ->active()
            ->whereType($type)
            ->orderBy('id', self::ASC)
            ->get();
    }
}