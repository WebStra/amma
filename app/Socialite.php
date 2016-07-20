<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class Socialite extends Repository
{
    use ActivateableTrait;

    const PROVIDER_FACEBOOK = 'facebook';
    const PROVIDER_GOOGLE = 'google';

    /**
     * @var string
     */
    protected $table = 'socialite_users';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider', 'provider_id', 'active', 'callback'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Query scope provider facebook.
     *
     * @param $query
     * @return mixed
     */
    public function scopeFacebook($query)
    {
        return $query->whereProvider(self::PROVIDER_FACEBOOK);
    }

    /**
     * Query scope provider google.
     *
     * @param $query
     * @return mixed
     */
    public function scopeGoogle($query)
    {
        return $query->whereProvider(self::PROVIDER_GOOGLE);
    }
}