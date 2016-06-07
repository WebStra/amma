<?php

use Illuminate\Database\Seeder as BaseSeeder;

abstract class Seeder extends BaseSeeder
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $instance;

    /**
     * Delete table by instance.
     *
     * @param $instance
     * @return void
     */
    public function deleteTable($instance = null)
    {
        if(! isset($instance))
            $instance = $this->instance;

        if(\Schema::hasTable($instance->getTable()))
            \DB::table($instance->getTable())->delete();
    }
}