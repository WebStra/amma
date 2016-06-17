<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class ProductsColors extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'products_colors';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'color_hash', 'active'];

    /**
     * @var bool
     */
    public $timestamps = false;
}