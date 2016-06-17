<?php

namespace App\Repositories;

use App\ProductsColors as Color;

class ProductsColorsRepository extends Repository
{
    /**
     * @return Color
     */
    public function getModel()
    {
        return new Color();
    }

    public function create($product, $color)
    {
        return self::getModel()
            ->create([
                'product_id' => is_numeric($product) ? $product : $product->id,
                'color_hash' => $color
            ]);
    }
}