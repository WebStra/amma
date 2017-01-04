<?php

namespace App\Repositories;

use App\Wallet;
use App\User;

class WalletRepository extends Repository
{
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
     * @return Wallet
     */
    public function create(User $user, array $data = null)
    {
        return $this->getModel()
            ->create([
                'user_id' => $user->id,
                'amount' => isset($data['amount']) ? $data['amount'] : 0,
                'type' => 'standard',
                'active' => isset($data['active']) ? $data['active'] : 1
            ]);
    }

    /**
     * @param $wallet
     * @param $amount
     * @return bool
     */
    public function refillWallet(Wallet $wallet, $amount)
    {
        // todo: add event which fires and save this operation.
        return $wallet->update([
            'amount' => $amount,
        ]);
    }
    public function find($user_id)
    {
        return $this->getModel()->whereUserId($user_id)->first();
    }
}