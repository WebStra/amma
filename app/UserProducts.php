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
    protected $fillable = ['user_id', 'product_id', 'vendor_id'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}