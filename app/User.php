<?php

namespace App;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\UserPresenter;
use Keyhunter\Administrator\AuthRepository as Authenticatable;

class User extends Authenticatable
{
    use Presenterable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var UserPresenter
     */
    protected $presenter = UserPresenter::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }
}
