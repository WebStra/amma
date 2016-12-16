<?php

namespace App\Repositories;

use App\ModelColors as Color;
use Illuminate\Database\Eloquent\Model;

class ModelColorsRepository extends Repository
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

    /**
     * Delete color.
     *
     * @param $color
     * @throws \Exception
     */
    public function delete($color)
    {
        if (is_numeric($color))
            $this->find((int)$color)->delete();

        if ($color instanceof Model)
            $color->delete();
    }

    public function getByProductAndColor($product, $color)
    {
        return self::getModel()
            ->where('product_id', is_numeric($product) ? $product : $product->id)
            ->where('color_hash', $color)
            ->first();
    }

    /**
     * Check if product has this color.
     *
     * @param $product
     * @param $color
     * @return bool
     */
    public function hasColor($product, $color)
    {
        if ($this->getByProductAndColor($product, $color))
            return true;

        return false;
    }
}