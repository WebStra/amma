<?php

namespace App\Payment\Orders;

use App\Repositories\WalletRepository;
use App\User;

class CreateWalletsUserOrder
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createBaseWalletsOrder()
    {

    }

    /**
     * @return WalletRepository
     */
    private function getWalletsRepository()
    {
        return (new WalletRepository());
    }
}