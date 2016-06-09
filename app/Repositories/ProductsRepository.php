<?php

namespace App\Repositories;

use App\Product;

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