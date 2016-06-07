<?php

namespace App;

use Keyhunter\Administrator\Repository;

class FavoriteProduct extends Repository
{
    /**
     * @var string
     */
    protected $table = 'users_favorite_products';

    /**
     * @var array
     */
    protected $fillable = ['active'];

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
    public function product()
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }
}