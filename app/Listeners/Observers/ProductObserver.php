<?php

namespace App\Listeners\Observers;

use Log;

class ProductObserver extends Observer
{
    public function deleted($model)
    {
        //todo: (HOT) fix this stuff
        if ($this->recordLogs())
            Log::info('[' . __METHOD__ . '()] -> Deleted model with id ' . $model->id);

        $this->deleteAllAttachements($model);
    }

    private function deleteAllAttachements($model)
    {
        if ($this->recordLogs())
            Log::info('[' . __METHOD__ . '()] Starting to delete all images of product: '. $model->id);

        $model->images()->get()->each(function ($image){
            if ($this->recordLogs())
                Log::info('[' . __METHOD__ . '()] Delete image: '. $image->id. ' name: '. $image->image);

            $image->delete();
        });
    }
}