<?php

namespace App\Listeners\Observers;

use App\Services\ImageProcessor;
use App\Image;
use Illuminate\Http\UploadedFile;
use Request;

class CategoryObserver extends Observer
{
    /**
     * On model saving.
     *
     * @param $category
     */
    public function saving($category)
    {
        $this->unsetNoneModelFields($category, $this->getUnsetFields());
    }

    /**
     * On model saved.
     *
     * @param $category
     */
    public function saved($category)
    {
        $this->saveImage($category);
    }

    /**
     * On model creating.
     *
     * @param $category
     */
    public function creating($category)
    {
        $this->unsetNoneModelFields($category, $this->getUnsetFields());
    }

    /**
     * @param $category
     * @throws \Exception
     */
    public function saveImage($category)
    {
        $image = Request::file('image');

        if ($image instanceof UploadedFile) {
            $this->removePreviousImage($category);
            $location = 'upload/categories/';
            $processor = new ImageProcessor();
            $processor->uploadAndCreate($image, $category, null, $location);
        }
    }

    /**
     * Fields for unset.
     *
     * @return array
     */
    public function getUnsetFields()
    {
        return [
            'image'
        ];
    }

    /**
     * Remove images.
     *
     * @param $category
     * @return void
     */
    private function removePreviousImage($category)
    {
        $images = $category->images; // Incoming array of images
        //, but for categories can exists only one image

        if(count($images))
            $images->each(function(Image $image){
                $image->delete();
                // remove image.
                // @events: deleted(); remove file
            });
    }
}