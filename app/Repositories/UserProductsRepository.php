<?php

namespace App\Repositories;

use App\UserProducts;

class UserProductsRepository extends Repository
{
    /**
     * @return UserProducts
     */
    public function getModel()
    {
        return new UserProducts();
    }

    /**
     * Create user->products relation through vendor.
     *
     * @param $vendor
     * @param $product
     * @return static
     */
    public function create($vendor, $product)
    {
        return self::getModel()
            ->create([
                'user_id' => \Auth::id(),
                'vendor_id' => is_numeric($vendor) ? $vendor : $vendor->id,
                'product_id' => is_numeric($product) ? $product : $product->id
            ]);
    }
}