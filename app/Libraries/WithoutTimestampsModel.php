<?php

namespace App\Libraries;

use Illuminate\Database\Eloquent\Model;

class WithoutTimestampsModel extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;
}