<?php

namespace App\Repositories;

use App\Payment\Operation;

class OperationRepository extends Repository
{
    /**
     * @return Operation
     */
    public function getModel()
    {
        return new Operation();
    }
}