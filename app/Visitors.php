<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class Visitors extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'visitors';

    /**
     * @var array
     */
    protected $fillable = ['active', 'ip'];


}