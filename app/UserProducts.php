<?php

namespace App;

use Keyhunter\Administrator\Repository;

class UserProducts extends Repository
{
    /**
     * @var string
     */
    protected $table = 'users_products';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'seller_id'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'id', 'seller_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }
}