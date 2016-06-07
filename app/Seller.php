<?php

namespace App;

use Keyhunter\Administrator\Repository;

class Seller extends Repository
{
    /**
     * @var string
     */
    protected $table = 'sellers';

    /**
     * @var array
     */
    protected $fillable = ['name', 'phone', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}