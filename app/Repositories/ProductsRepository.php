<?php

namespace App\Repositories;

use App\Libraries\Categoryable\Categoryable;
use App\Product;
use App\ProductsColors;
use App\Services\ImageProcessor;
use App\UserProducts;
use Illuminate\Http\UploadedFile;

class ProductsRepository extends Repository
{
    /**
     * @return Product
     */
    public function getModel()
    {
        return new Product();
    }

    /**
     * Get all published products
     * 
     * @return mixed
     */
    public function getPublic()
    {
        return self::getModel()
            ->published()
            ->get();
    }

    /**
     * @param array $data
     * @param $vendor
     * @return Product
     */
    public function create(array $data)
    {
        return self::getModel()
            ->create([
                'name' => $data['name'],
                'price' => $data['price'],
                'sale' => (isset($data['sale'])) ? $data['sale'] : 0,
                'count' => (isset($data['count'])) ? $data['count'] : 1,
                'type' => (isset($data['type'])) ? $data['type'] : 'new',
                'status' => 'drafted',
                'published_date' => $data['published_date'],
                'expiration_date' => $data['expiration_date'],

            ]);

        // todo: change it for other stuff.
        UserProducts::create([
            'user_id' => \Auth::id(),
            'product_id' => $product->id,
            'vendor_id' => $vendor->id
        ]);

        if (isset($data['images'])) {
            array_walk($data['images'], function($image) use($product) {
                if($image instanceof UploadedFile) {
                    $location = 'upload/products/' . $product->id;
                    $processor = new ImageProcessor();
                    $processor->uploadAndCreate($image, $product, null, $location);
                }
            });
        }

        return $product;
    }

    /**
     * Get random products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSomeRandomProducts() {
        $random_element_1 = rand(1, 2);
        $random_element_2 = rand(1, 2);
        $random_element_3 = rand(1, 2);

        $query = self::getModel()->select('*');

        if ($random_element_1 == 1) {
            $query->published();
        } else {
            $query->drafted();
        }

        if ($random_element_2 == 1) {
            $query->whereType('old');
        } else {
            $query->whereType('new');
        }

        if ($random_element_3 == 1) {
            $query->whereBetween('sale', [1, 50]);
        } else {
            $query->whereBetween('sale', [51, 100]);
        }

        return $query->get();
    }
}