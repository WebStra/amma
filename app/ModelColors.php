<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class ModelColors extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'model_colors';

    /**
     * @var array
     */
    protected $fillable = ['product_id','size_id','color_hash', 'amount', 'active'];

    /**
     * @var bool
     */
    public $timestamps = false;
}