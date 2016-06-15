<?php

namespace App;

use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\ImagePresenter;
use Keyhunter\Administrator\Repository;

class Image extends Repository
{
    use Presenterable;

    /**
     * @var array
     */
    protected $fillable = ['type', 'original', 'image', 'imageable_type', 'imageable_id'];

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
}