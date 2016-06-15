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

        $file = $data['image'];
        $data = ['attach' => $vendor];
        $location = 'upload/vendors/'. $vendor->id;

        $processor = new ImageProcessor();
        $processor->uploadAndCreate($file, $data, $location);

        return $vendor;
    }
}