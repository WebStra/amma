<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class Social extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'socials';

    /**
     * @var array
     */
    protected $fillable = ['key', 'link'];

    /**
     * @var bool
     */
    public $timestamps = false;
}