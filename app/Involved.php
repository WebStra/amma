<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class Involved extends Repository
{
    use ActivateableTrait;
    
    /**
     * @var string
     */
    protected $table = 'involved';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'product_id','lot_id', 'active', 'count','price_id','color_id','size_id','product_hash','type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buyer()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function lot()
    {
        return $this->hasOne(Lot::class, 'id', 'lot_id');
    }

    public function involvedColor()
    {
        return $this->hasOne(ModelColors::class, 'id' ,'color_id');
    }

    public function specPrice()
    {
        return $this->hasOne(SpecPrice::class, 'id' ,'price_id');
    }

    public function improvedSpec()
    {
        return $this->hasOne(ImprovedSpec::class, 'id', 'size_id');
    }

}