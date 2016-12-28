<?php

namespace App\Listeners\Observers;
use App\Services\ImageProcessor;
use Illuminate\Http\UploadedFile;
use Request;
use App\Image;


class VendorsObserver extends Observer
{
    /**
     * On model saved.
     *
     * @param $vendor
     */

    public function saved($vendor)
    {
        $this->saveImage($vendor);
    }

    /**
     * On model creating.
     *
     * @param $vendor
     */
    public function creating($vendor)
    {
        $this->unsetNoneModelFields($vendor, $this->getUnsetFields());
    }

    /**
     * @param $vendor
     * @throws \Exception
     */
    public function saveImage($vendor)
    {
        $image = Request::file('image');

        if($image) {
            if ($image instanceof UploadedFile) {
                $this->removePreviousImage($vendor);
                $location = 'upload/vendors/'.$vendor->id;
                $processor = new ImageProcessor();
                $processor->uploadAndCreate($image, $vendor, null, $location);
            } else {
                throw new \Exception('Invalid Image');
            }
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
     * @param $vendor
     * @return void
     */
    private function removePreviousImage($vendor)
    {
        $images = $vendor->images; // Incoming array of images
        //, but for categories can exists only one image

        if(count($images))
            $images->each(function(Image $image){
                $image->delete();
                // remove image.
                // @events: deleted(); remove file
            });


    }
}