<?php

namespace App\Orders;

use App\Repositories\WalletRepository;
use App\User;

class CreateWalletOrder extends Order
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var int
     */
    protected $test_count;

    /**
     * CreateWalletOrder constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->test_count = config('testing_payment.amount');

        parent::__construct();
    }

    /**
     * Method witch run's on serialize object.
     *
     * @return void.
     */
    public function handle()
    {
//        if(! $this->user->hasWallet())
        if(! $this->user->wallet()->first())
        {
            $data['amount'] = 0;
            if($this->checkIfTestWalletPeriodOn())
            {
                $data['amount'] = $this->test_count;
            }

            $this->getWalletsRepository()
                ->create($this->user, $data);
        }
    }

    /**
     * Check if testing period.
     *
     * @return string|null
     */
    public function checkIfTestWalletPeriodOn()
    {
        return settings()->getOption('site::testing_payment_period');
    }

    /**
     * @return WalletRepository
     */
    private function getWalletsRepository()
    {
        return (new WalletRepository());
    }
}