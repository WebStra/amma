<?php

namespace App;

use App\Libraries\Categoryable\CategoryableTrait;
use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\ProductPresenter;
use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class Product extends Repository
{
    use CategoryableTrait, ActivateableTrait, Presenterable;
    
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var ProductPresenter
     */
    protected $presenter = ProductPresenter::class;

    /**
     * @var array
     */
    protected $dates = ['expiration_date', 'published_date'];

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'sale', 'count', 'type', 'status', 'published_date', 'expiration_date', 'active'
    ];

    /**
     * Drafted products scope.
     *
     * @param $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeDrafted($query)
    {
        return $query->whereStatus('drafted');
    }

    /**
     * Published products scope.
     *
     * @param $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereStatus('published');
    }

    /**
     * Completed products scope.
     *
     * @param $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->whereStatus('completed');
    }
}