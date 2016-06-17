<?php

namespace App\Repositories;

use App\Services\ImageProcessor;
use App\Vendor;
use Auth;

class VendorRepository extends Repository
{
    /**
     * @return Vendor
     */
    public function getModel()
    {
        return new Vendor();
    }

    /**
     * Create method.
     *
     * @param array $data
     * @return Vendor
     */
    public function create(array $data)
    {
        $vendor = self::getModel()
            ->create([
                'user_id' => Auth::id(),
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'description' => $data['description']
            ]);

        if (isset($data['image'])) {
            $file = $data['image'];
            $location = 'upload/vendors/' . $vendor->id;
            $processor = new ImageProcessor();
            $processor->uploadAndCreate($file, $vendor, $data, $location);
        }

        return $vendor;
    }

    /**
     * Update method.
     *
     * @param Vendor $vendor
     * @param $data
     * @throws \Exception
     */
    public function update(Vendor $vendor, $data)
    {
        $vendor->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'description' => $data['description'],
            'phone' => $data['phone']
        ]);

        if (isset($data['image'])) {
            $file = $data['image'];
            $location = 'upload/vendors/' . $vendor->id;
            $processor = new ImageProcessor();
            $processor->destroy($vendor->images()->first()); // delete old logo.

            $processor->uploadAndCreate($file, $vendor, $data, $location);
        }

        $vendor->save();
    }
}