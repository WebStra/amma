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
     * Format date.
     *
     * @param $date
     * @param string $format
     * @return mixed
     */
    public function date($date, $format = 'd.m.Y')
    {
        return $this->model->$date->format($format);
    }

    /**
     * Created at.
     *
     * @param string $format
     * @return mixed
     */
    public function created($format = 'd.m.Y')
    {
        return $this->date($this->model->created_at, $format);
    }

    /**
     * Updated at.
     *
     * @param string $format
     * @return mixed
     */
    public function updated($format = 'd.m.Y')
    {
        return $this->date($this->model->updated_at, $format);
    }

    /**
     * Get all presenter methods for current presentor instance.
     *
     * @return array
     */
    public function presentors()
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