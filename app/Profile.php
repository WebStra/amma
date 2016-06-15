<?php

namespace App;

use App\Traits\ActivateableTrait;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'profiles';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'firstname', 'lastname', 'phone', 'active'];

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
}