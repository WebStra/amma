<?php

namespace App\Libraries\Presenterable\Presenters;

use Illuminate\Database\Eloquent\Model;

abstract class Presenter
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Presenter constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}