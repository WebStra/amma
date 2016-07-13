<?php

namespace App;

use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\ImagePresenter;
use App\Libraries\Rankable\HasRank;
use App\Listeners\Observers\ImageObserver;
use Keyhunter\Administrator\Repository;

class Image extends Repository
{
    use Presenterable, HasRank;

    /**
     * @var array
     */
    protected $fillable = ['type', 'original', 'image', 'imageable_type', 'imageable_id', 'rank'];

    /**
     * @var ImagePresenter
     */
    protected $presenter = ImagePresenter::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Scope cover image.
     *
     * @param $query
     * @return mixed
     */
    public function scopeCover($query)
    {
        return $query->whereType('cover');
    }

   /**
     * Scope avatar image.
     *
     * @param $query
     * @return mixed
     */
    public function scopeAvatar($query)
    {
        return $query->whereType('avatar');
    }
}