<?php

namespace App\Libraries\Presenterable\Presenters;

use Illuminate\Database\Eloquent\Model;
use ReflectionMethod;

abstract class Presenter
{
    /**
     * @var Model
     */
    public $model;

    /**
     * Presenter constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all presenter methods.
     *
     * @return array
     */
    public function masks()
    {
        $masks   = [];
        $methods = get_class_methods($this);

        array_walk($methods, function ($method) use (&$masks) {
            $r = new ReflectionMethod(get_class($this), $method);

            $masks[$method] = $r;
        });

        return $masks;
    }
}