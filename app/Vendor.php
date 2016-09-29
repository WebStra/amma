<?php

namespace App;

use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\VendorPresenter;
use App\Traits\ActivateableTrait;
use App\Traits\HasImages;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Keyhunter\Administrator\Repository;
use App\Libraries\Likeable\Likeable as LikeableTrait;

class Vendor extends Repository implements SluggableInterface
{
    use LikeableTrait, ActivateableTrait, SluggableTrait, Presenterable, HasImages;

    /**
     * @var string
     */
    protected $table = 'vendors';

    /**
     * @var VendorPresenter
     */
    protected $presenter = VendorPresenter::class;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'description', 'active', 'email', 'slug', 'user_id'
    ];

    /**
     * @var array
     */
    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function lots()
    {
        return $this->hasMany(Lot::class, 'vendor_id', 'id');
    }

}