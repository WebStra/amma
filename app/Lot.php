<?php

namespace App;

use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\LotPresenter;
use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class Lot extends Repository
{
    use ActivateableTrait, Presenterable;

    /** `status` field options */
    const STATUS_DRAFTED = 'drafted';
    const STATUS_COMPLETE = 'complete';
    const STATUS_DELETED = 'deleted';
    
    

    /** `verify_status` field options */
    const STATUS_VERIFY_ACCEPTED = 'verified';
    const STATUS_VERIFY_DECLINED = 'declined';
    const STATUS_VERIFY_PENDING = 'pending';

    /** `sell_status` field options */
    const STATUS_SELL_DEFAULT = 'default';
    const STATUS_ACCEPT_DECLINED = 'accept';
    const STATUS_SELL_DECLINED = 'declined';
    /**
     * @var string
     */
    protected $table = 'lots';

    /**
     * @var LotPresenter
     */
    public $presenter = LotPresenter::class;

    /**
     * @var array
     */
    protected $fillable = [
        'vendor_id',
        'category_id',
        'currency_id',
        'name',
        'yield_amount',
        'description',
        'public_date',
        'expire_date',
        'status',
        'verify_status',
        'active',
        'comision',
        'description_delivery',
        'description_payment',
        'sell_status',
        'comision_extract'
    ];

    protected $dates = [
        'public_date',
        'expire_date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function specPrice()
    {
        return $this->hasMany(SpecPrice::class, 'lot_id', 'id');
    }

    public function involved()
    {
        return $this->hasMany(Involved::class, 'lot_id', 'id')->active();
    }

    public function involvedTotalPrice()
    {
        return $this->belongsToMany(SpecPrice::class, 'involved', 'lot_id','price_id')->selectRaw('product_specifications_price.new_price * involved.count as price')->wherePivot('active', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'lot_id', 'id');
    }

    public function lotDelivery()
    {
        return $this->hasMany(LotDeliveryPayment::class, 'lot_id', 'id')->where('method_type','delivery');
    }

    public function lotDeliveryPayment()
    {
        return $this->hasMany(LotDeliveryPayment::class, 'lot_id', 'id')->where('method_type','payment');
    }

    public function subCategories()
    {
        return $this->hasManyThrough(
            SubCategory::class, Category::class,
            'id', 'category_id', 'category_id'
        );
    }

    /**
     * Query scope if lot is drafted.
     *
     * @param $query
     * @return mixed
     */
    public function scopeDrafted($query)
    {
        return $query->where('status', self::STATUS_DRAFTED);
    }

    /**
     * Query scope if lot is completed.
     *
     * @param $query
     * @return mixed
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETE);
    }

    /**
     * Query scope if lot is verified.
     *
     * @param $query
     * @return mixed
     */
    public function scopeVerified($query)
    {
        return $query->where('verify_status', self::STATUS_VERIFY_ACCEPTED);
    }

    /**
     * Query scope if lot is declined.
     *
     * @param $query
     * @return mixed
     */
    public function scopeDeclined($query)
    {
        return $query->where('verify_status', self::STATUS_VERIFY_DECLINED);
    }

    /**
     * Query scope if lot is pending.
     *
     * @param $query
     * @return mixed
     */
    public function scopePending($query)
    {
        return $query->where('verify_status', self::STATUS_VERIFY_PENDING);
    }

    /**
     * Query scope if lot is published.
     *
     * @param $query
     * @return mixed
     */
    public function scopePublic($query)
    {
        return $query
            ->where('status', self::STATUS_COMPLETE)
            ->where('verify_status', self::STATUS_VERIFY_ACCEPTED);
    }
}