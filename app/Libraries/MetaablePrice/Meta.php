<?php

namespace App\Libraries\MetaablePrice;

use Keyhunter\Administrator\Repository as KeyhunterRepository;

class Meta extends KeyhunterRepository
{
    /**
     * @var string
     */
    protected $table = 'product_specifications_price';

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $fillable = [ 'product_id','price_new','price_old','sale','size', 'color_hash', 'amount','key','value'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function metaablePrice()
    {
        return $this->morphTo();
    }

    /**
     * Scope meta group.
     *
     * @param $query
     * @param $group
     * @return mixed
     */
    public function scopeGroup($query, $group)
    {
        return $query->whereGroup($group);
    }
}