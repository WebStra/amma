<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class LotDeliveryPayment extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'lot_delivery_payment';

    /**
     * @var array
     */
    public $timestamps = false;
    protected $fillable = ['lot_id', 'method_id', 'method_type'];

    public function lot()
    {
        return $this->hasMany(Lot::class, 'lot_id', 'id');
    }
}