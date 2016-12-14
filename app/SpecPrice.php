<?php

namespace App;

use Keyhunter\Administrator\Repository;

class SpecPrice extends Repository
{
    /**
     * @var string
     */
    protected $table = 'product_specifications_price';

    /**
     * @var array
     */
    protected $fillable = [ 'product_id','price_new','price_old','sale','size', 'color_hash', 'amount','key','value'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * @var bool
     */
    public $timestamps = false;
}