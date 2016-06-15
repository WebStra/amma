<?php
namespace App;

use App\Traits\ActivateableTrait;
use App\Traits\RankedableTrait;
use Keyhunter\Administrator\Repository;

class Partner extends Repository
{
    use ActivateableTrait, RankedableTrait;

    /**
     * @var string
     */
    protected $table = 'partners';

    /**
     * @var array
     */
    protected $fillable = ['name', 'link', 'active', 'rank'];

    /**
     * @var bool
     */
    public $timestamps = false;
}