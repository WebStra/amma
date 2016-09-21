<?php

namespace App\Listeners\Observers;

use Cviebrock\EloquentTaggable\Services\TagService;

class TagObserver extends Observer
{

    /**
     * On saving tag runs this event.
     *
     * @param $model
     *
     * @return mixed
     */
    public function saving($model)
    {
        return $this->generateNormalize($model);
    }

    /**
     * Generate normalized field from original name (default locale).
     *
     * @param $model
     *
     * @return mixed
     */
    public function generateNormalize($model)
    {
        $model->normalized = $this->normalize($model->name);

        return $model;
    }

    /**
     * Normalize a string.
     *
     * @param string $string
     *
     * @return mixed
     */
    public function normalize($string)
    {
        return app(TagService::class)->normalize($string);
    }
}