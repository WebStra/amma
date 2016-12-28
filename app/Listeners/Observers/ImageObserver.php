<?php

namespace App\Listeners\Observers;

use App\Services\ImageProcessor;
use Log;

class ImageObserver extends Observer
{
    /**
     * On creating.
     *
     * @param $model
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function creating($model)
    {
        $lastRank = $model->getLastRank();

        $model->rank = ($lastRank) ? $lastRank->rank + 1 : 1;

        if ($this->recordLogs())
            Log::info('[' . __METHOD__ . '()] -> User added to model rank ' . $lastRank->rank, [
                'id' => \Auth::id()
            ]);

        return $model;
    }

    /**
     * On deleting.
     *
     * @param $model
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function deleting($model)
    {
        if ($this->recordLogs())
            Log::info('[' . __METHOD__ . '()] -> User deleting model with id ' . $model->id, [
                'id' => \Auth::id()
            ]);

        $destroyed =(new ImageProcessor)->destroyImageOnly($model);

        if($this->recordLogs() && $destroyed)
            Log::info('[' . __METHOD__ . '()] -> Image '.$model->image.' was deleted from folder');
    }

    /**
     * On deleted.
     *
     * @param $model
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function deleted($model)
    {
        if ($this->recordLogs())
            Log::info('[' . __METHOD__ . '()] -> Deleted model with id ' . $model->id);
    }
}