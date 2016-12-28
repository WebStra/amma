<?php

namespace App\Listeners\Observers;

class Observer
{
    public function recordLogs()
    {
        return config('app.observers_logs');
    }

    /**
     * Unset none model fields.
     *
     * @param $model
     * @param array|null $fields
     * @return void
     */
    public function unsetNoneModelFields($model, array $fields = [])
    {
        array_walk($fields, function ($field) use (&$model) {
            unset($model->$field);
        });
    }
}