<?php
namespace App;
use App\Libraries\WithoutTimestampsModel;
class MethodDeliveryPaymentTransaltion extends WithoutTimestampsModel
{
    public $timestamps  = false;
    protected $table    = 'method_delivery_payment_translations';
    protected $fillable = ['name'];
}
