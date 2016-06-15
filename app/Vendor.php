<?php

namespace App;

use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\VendorPresenter;
use App\Traits\ActivateableTrait;
use App\Traits\HasImages;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Keyhunter\Administrator\Repository;

class Vendor extends Repository implements SluggableInterface
{
    use ActivateableTrait, SluggableTrait, Presenterable, HasImages;

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
    public function products()
    {
//        return $this->hasManyThrough(Product::class, UserProducts::class, 'vendor_id', 'product_id');
        return $this->hasMany(UserProducts::class);
    }
}