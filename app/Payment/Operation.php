<?php

namespace App\Payment;

use App\Wallet;
use Keyhunter\Administrator\Repository;

class Operation extends Repository
{
    /**
     * @var string
     */
    protected $table = 'payments_operations';

    /**
     * @var array
     */
    protected $fillable = ['transaction_id', 'transaction_type', 'wallet_id', 'amount', 'type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}