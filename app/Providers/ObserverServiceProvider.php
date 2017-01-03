<?php

namespace App\Providers;

use App\Category;
use App\Image;
use App\Listeners\Observers\CategoryObserver;
use App\Listeners\Observers\ImageObserver;
use App\Listeners\Observers\ProductObserver;
use App\Listeners\Observers\SubCategoryObserver;
use App\Listeners\Observers\TagObserver;
use App\Listeners\Observers\VendorsObserver;
use App\Listeners\Observers\LotObserver;
use App\Product;
use App\Lot;
use App\Vendor;
use App\SubCategory;
use App\Tag;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * List of observers which belongs to models
     *
     * @var array
     */
    protected $observers = [
        Image::class       => ImageObserver::class,
        Product::class     => ProductObserver::class,
        Category::class    => CategoryObserver::class,
        SubCategory::class => SubCategoryObserver::class,
        Tag::class         => TagObserver::class,
        Vendor::class      => VendorsObserver::class,
        Lot::class         => LotObserver::class
    ];

    /**
     * Register observers.
     *
     * @return void.
     */
    public function register()
    {
        //
    }

    /**
     * Registering observers SHOULD BE in boot() method.
     * 
     * @return void.
     */
    public function boot()
    {
        array_walk($this->observers, function ($observer, $model) {
            $model::observe(new $observer);
        });
    }
}