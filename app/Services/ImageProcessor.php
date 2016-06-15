<?php

namespace App\Services;

use App\Image;
use Exception;
use Illuminate\Database\Eloquent\Model;

class ImageProcessor
{
    protected $location = 'upload/images';

    protected $filename;
    
    /**
     * @return Image
     */
    public function getModel()
    {
        return new Image();
    }

    public function uploadAndCreate($image, $data, $location = null)
    {
        if ($image instanceof \Illuminate\Http\UploadedFile) {
            if ($data['attach'] instanceof Model) {
                $original = $image->getClientOriginalName();
                if(isset($location))
                    $this->setLocation($location);

                if($imageInfo = $this->upload($image))
                    return $this->getModel()->create([
                        'imageable_id' => $data['attach']->id,
                        'imageable_type' => get_class($data['attach']),
                        'type' => isset($data['type'])? $data['type'] : 'cover',
                        'original' => $original,
                        'image' => str_replace(base_path('public'), '', $imageInfo->getPathname())
                    ]);

            } else {
                throw new \Exception('Invalid attach model!');
            }
        } else {
            throw new \Exception('Invalid uploaded image!');
        }
    }

    /**
     * Render image name.
     *
     * @param $image
     * @return string
     */
    private function getNewImageName($image)
    {
        $hash = md5_file($image->getRealPath());
        $ext = $image->getClientOriginalExtension();
        return "{$hash}.{$ext}";
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set location.
     *
     * @param $location
     * @return $this
     */
    public function setLocation($location)
    {
        $this->location = trim($location, '/');

        return $this;
    }

    /**
     * @param $location
     * @throws Exception
     */
    protected function validateLocation($location)
    {
        $fileExists = file_exists($location);

        if ((! $fileExists && ! mkdir($location, 0777, true)) || ! is_writeable($location)) {
            throw new Exception("Location [$location] not exists or not writable");
        }
    }

    protected function upload($image)
    {
        $location = base_path("public/" . $this->location);

        $this->validateLocation($location);

        if ($image) {
            if ($image->isValid()) {
                $filename = rtrim($location, '/') . '/' . ltrim($this->getNewImageName($image), '/');

                $this->filename = $filename;

                return $image->move($location, $filename);
            }
        }

        return false;
    }
}