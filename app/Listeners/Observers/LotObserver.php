<?php

namespace App\Listeners\Observers;
use App\Repositories\WalletRepository;

use Request;


class LotObserver extends Observer
{


    public function saved($lot)
    {
        if ($lot->verify_status == 'verified') {
            $wallet = $this->getWalletRepository()->find(\Auth::id());
            if($lot->comision_extract == 'No'){
                $this->getWalletRepository()->refillWallet($wallet, $wallet->amount - $lot->comision);
                $lot->comision_extract = 'Yes';
                $lot->save();
            }
        }
        elseif($lot->verify_status == 'declined') {
            $lot->status = 'drafted';
            $lot->save();
        }
    }

    /**
    * @return WalletRepository
    */
    private function getWalletRepository()
    {
        return (new WalletRepository);
    }

}