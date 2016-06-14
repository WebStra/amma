<?php

namespace App\Repositories;

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
        return self::getModel()
            ->create([
                'user_id' => Auth::id(),
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'description' => $data['description']
            ]);
    }
}