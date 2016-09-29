<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class Currency extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'currencies';

    /**
     * @var array
     */
    protected $fillable = [ 'title', 'sign', 'active' ];
}