<?php

namespace App;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\UserPresenter;
use App\Repositories\RolesRepository;
use App\Traits\ActivateableTrait;
use App\Traits\Confirmed;
use Keyhunter\Administrator\AuthRepository as Authenticatable;
use App\Traits\HasImages;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable implements CanResetPasswordContract
{
    use Presenterable, Confirmed, ActivateableTrait, HasImages, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'confirmation_code', 'confirmed'
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
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function involved()
    {
        return $this->hasMany(Involved::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function socialite()
    {
        return $this->belongsTo(Socialite::class, 'id', 'user_id');
    }

    /**
     * Check if current user is socialite user.
     *
     * @return bool
     */
    public function isSocialite()
    {
        return (bool)$this->socialite;
    }

    /**
     * Check if user have avatar.
     *
     * @return bool
     */
    public function checkAvatar()
    {
        return (bool)$this->images()->avatar()->first();
    }

    public function isAdmin()
    {
        $admin = (new RolesRepository)->getAdminRole();

        return $this->role_id == $admin->id;
    }

    /**
     * Check if user has wallet.
     *
     * @return bool
     */
    public function haveWallet()
    {
        //return (bool) $this->wallet()->first();
    }
}
