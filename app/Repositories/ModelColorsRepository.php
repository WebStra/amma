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

    public function create(array $data,$specSize)
    {
        return self::getModel()
            ->create([
                'size_id'    => $specSize->id,
                'product_id' => $specSize->product_id,
                'color_hash' => (isset($data['color_hash']) ? $data['color_hash'] : ''),
                'amount'     => (isset($data['amount']) ? $data['amount'] : '')
            ]);
    }
    public function save(array $data, $specSize)
    {
        $key = ((isset($data['key']) &&  $data['key'] != null) ? $data['key'] : null);
        $color             = self::getModel()->firstOrNew(array('key'=>$key));
        $color->size_id    = $specSize->id;
        $color->product_id = $specSize->product_id;
        $color->color_hash = (isset($data['color_hash']) ? $data['color_hash'] : '');
        $color->amount     = (isset($data['amount']) ? $data['amount'] : '');
        $color->key         = (isset($data['key']) ? $data['key'] : '');
        $color->save();
        return $color;
    }

    public function find($slug)
    {
        if (is_numeric($slug))
            return $this->getModel()
                ->whereId((int) $slug)
                ->first();

        return $this->getModel()
            ->whereSlug($slug)
            ->first();
    }
    
    public function findKey($key)
    {
        return $this->getModel()
            ->whereKey($key)
            ->first();
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