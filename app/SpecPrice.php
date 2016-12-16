<?php

namespace App;
use App\Libraries\Metaable\HasMeta;
use Keyhunter\Administrator\Repository;
use Illuminate\Database\Eloquent\Builder;
use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\SpecPricePresenter;
class SpecPrice extends Repository
{
    use HasMeta, Presenterable;
    /**
     * @var string
     */
    protected $table = 'product_specifications_price';

    /**
     * @var array
     */
    protected $fillable = [ 'product_id','price_new','price_old','sale','size', 'color_hash', 'amount','key','value'];

    protected $presenter = SpecPricePresenter::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function improvedSpecs()
    {
        return $this->hasMany(ImprovedSpec::class, 'price_spec_id', 'id');
    }

    public function specColors()
    {
        return $this->hasMany(ModelColors::class, 'size_id', 'id')->orderBy('id','DESC');
    }

    /**
     * @var bool
     */
    public $timestamps = false;
}