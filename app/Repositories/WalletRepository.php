<?php

namespace App\Repositories;

use App\Wallet;
use App\User;

class WalletRepository extends Repository
{
    const TEST = 'sandbox';

    const REAL = 'production';

    /**
     * @return Wallet
     */
    public function getModel()
    {
        return new Wallet();
    }

    /**
     * @param User $user
     * @param array|null $data
     * @return static
     */
    public function create(User $user, array $data = null)
    {
        return $this->getModel()
            ->create([
                'user_id' => $user->id,
                'amount' => isset($data['amount']) ? $data['amount'] : 0,
                'type' => isset($data['type']) ? $data['type'] : self::TEST,
                'active' => isset($data['active']) ? $data['active'] : 1
            ]);
    }

    /**
     * @param $wallet
     * @param $amount
     * @return WalletRepository
     */
    public function refillWallet(Wallet $wallet, $amount)
    {
        // todo: add event which fires and save this operation.
        return $wallet->update([
            'amount' => $amount,
        ]);
    }

    public function getTest()
    {
        return self::TEST;
    }

    public function getActiveWallets()
    {
        return self::getModel()
            ->active()
            ->get();
    }
}