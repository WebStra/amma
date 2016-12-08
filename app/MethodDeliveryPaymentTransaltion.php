<?php
namespace App;
use App\Libraries\TranslatableModel;
class MethodDeliveryPaymentTransaltion extends TranslatableModel 
{
    public $timestamps  = false;
    protected $table    = 'method_delivery_payment_translations';
    protected $fillable = ['name'];
}
