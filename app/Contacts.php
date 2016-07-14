<?php

namespace App;

use App\Traits\ActivateableTrait;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'contact_requests';

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'email', 'phone', 'message','active'];
}