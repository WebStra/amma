<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class Wallet extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'user_wallets';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'amount', 'type', 'active'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope type.
     * 
     * @param $query
     * @return mixed
     */
    public function scopeSandbox($query)
    {
        return $query->whereType('sandbox');
    }
}