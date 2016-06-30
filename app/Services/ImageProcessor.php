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

    /**
     * Upload and create image for imageable instance.
     *
     * @param $image
     * @param $imageable
     * @param null $data
     * @param null $location
     * @return static
     * @throws Exception
     */
    public function uploadAndCreate($image, $imageable, $data = null, $location = null)
    {
        if($this->validateImage($image)) {
            $original = $image->getClientOriginalName();
            if (isset($location))
                $this->setLocation($location);
            
            if ($imageInfo = $this->upload($image))
                return $this->getModel()->create([
                    'imageable_id' => $imageable->id,
                    'imageable_type' => get_class($imageable),
                    'type' => isset($data['type']) ? $data['type'] : 'cover',
                    'original' => $original,
                    'image' => str_replace(base_path('public'), '', $imageInfo->getPathname()),
                ]);
        }
    }

    /**
     * Validate incoming image.
     *
     * @param $image
     * @return bool
     */
    private function validateImage($image)
    {
        if ($image instanceof \Illuminate\Http\UploadedFile)
            return true;

        return false;
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
        $time = time();
        return "{$time}_{$hash}.{$ext}";
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Image $image
     */
    public function destroy($image)
    {
        if($image) {
            $location = ltrim($image->image, '/');
            @unlink(base_path("public/{$location}"));

            $image->delete();
        }
    }

    /**
     * Delete only image form folder.
     *
     * @param $image
     * @return bool
     */
    public function destroyImageOnly($image)
    {
        if($image) {
            $location = ltrim($image->image, '/');
            return @unlink(base_path("public/{$location}"));
        }
        
        return false;
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