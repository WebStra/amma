<?php

namespace App\Libraries\Presenterable\Presenters;

class ImagePresenter extends Presenter
{
    /**
     * Generate path to image with size or just return path to image.
     * 
     * @param null $size (available sizes ('big', 'medium', 'small'))
     * @return string
     */
    public function image($size = null)
    {
        $image = $this->model->image;

        if(! empty($image))
            if(! is_null($size)) {
                list($pathName, $mime) = explode('.', $image);

                $image = sprintf('%s_%s.%s', $pathName, $size, $mime);
            }

        return $image;
    }
}