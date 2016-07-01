<?php

namespace App;

use Keyhunter\Administrator\Repository;

class Involved extends Repository
{
    /**
     * @var string
     */
    protected $table = 'involved';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}