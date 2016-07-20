<?php

namespace App\Services;

use App\Image;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ImageProcessor
{
    const MIME_JPEG = 'image/jpeg';
    const MIME_JPG  = 'image/jpg';
    const MIME_PNG  = 'image/png';
    const MIME_GIF  = 'image/gif';

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

            $data['original'] = $original;

            if ($imageInfo = $this->upload($image))
            {
                return $this->create($imageInfo->getPathname(), $imageable, $data);
            }
        }
    }

    /**
     * Download image to server and get as UploadedFile object.
     *
     * @param $url
     * @param $imageable
     * @param array|null $data
     * @param string $location
     * @return static
     */
    public function downloadAndUpload($url, $imageable, array $data = null, $location = 'upload/images/')
    {
        $file = file_get_contents($url); // download the image from url.
        $extension = $this->parseExtension(getimagesize($url)['mime']);

        if (isset($location))
            $this->setLocation($location);
        $filename = time() .'_'. str_random(15);

        $path_to_image = $this->pattern($filename, $extension, $location);
        file_put_contents($path_to_image, $file);

        $imageInfo = new UploadedFile($path_to_image, str_random(10));
        $data = array_merge(['original' => $filename], $data);

        return $this->create($imageInfo->getRealPath(), $imageable, $data);
    }

    /**
     * Validate incoming image.
     *
     * @param $image
     * @return true
     */
    private function validateImage($image)
    {
        if ($image instanceof UploadedFile)
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

    /**
     * Change avatar.
     *
     * @param $avatar
     * @param string $location
     * @return $this
     */
    public function changeAvatar($avatar, $location = 'upload/images/user_avatars/')
    {
        if ($old_avatar = \Auth::user()->images()->avatar()->first())
            $this->destroy($old_avatar);

        if(is_string($avatar)) { // check if url.
            $this->downloadAndUpload($avatar, \Auth::user(), ['type' => 'avatar'], $location);

            return $this;
        }

        $this->uploadAndCreate($avatar, \Auth::user(), ['type' => 'avatar'], $location);

        return $this;
    }

    /**
     * Standart pattern.
     *
     * @param $location
     * @param $filename
     * @param $extension
     * @return string
     */
    private function pattern($filename, $extension, $location = null)
    {
        if(! $location)
            return sprintf('%s.%s', $filename, $extension);

        return sprintf('%s%s.%s', $location, $filename, $extension);
    }

    /**
     * Parse extension.
     *
     * @param $mime
     * @return string
     */
    private function parseExtension($mime)
    {
        switch ($mime)
        {
            case self::MIME_JPEG:
                return 'jpeg';
                break;
            case self::MIME_JPG:
                return 'jpg';
                break;
            case self::MIME_PNG:
                return 'png';
                break;
            case self::MIME_GIF:
                return 'gif';
                break;
            default:
                return 'jpeg';
                break;
        }
    }

    private function create($path, $imageable, array $data = null)
    {
        return $this->getModel()->create([
            'imageable_id' => $imageable->id,
            'imageable_type' => get_class($imageable),
            'type' => isset($data['type']) ? $data['type'] : 'cover',
            'original' => isset($data['original']) ? $data['original'] : str_random(13),
            'image' => str_replace(base_path('public'), '', $path),
        ]);
    }
}