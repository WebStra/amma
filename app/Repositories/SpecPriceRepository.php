<?php

namespace App\Repositories;

use App\SpecPrice;
use App\Product;
class SpecPriceRepository extends Repository
{
    /**
     * @return SpecPrice
     */
    public function getModel()
    {
        return new SpecPrice();
    }

    /**
     * @param $product_id
     * @return static
     */
    public function createPlain($product_id)
    {
        return self::getModel()
            ->create([
                'product_id' => $product_id
            ]);
    }

    /**
     * Find model by id/slug.
     *
     * @param $id
     * @return SpecPrice
     */
    public function find($id)
    {
        return $this->getModel()
            ->whereId((int) $id)
            ->first();
    }
    
    public function findKey($key)
    {
        return $this->getModel()
            ->whereKey($key)
            ->first();
    }

    /**
     * Delete model..
     * 
     * @param SpecPrice $model
     */
/*    public function delete(SpecPrice $model)
    {
        $model->delete();
    }*/
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Update suite of improved specs.
     * 
     * @param $spec
     * @param array $data
     * @return mixed
     */

    public function create(array $data, $product)
    {
        return self::getModel()
            ->create([
                'lot_id'     => $product->lot_id,
                'product_id' => $product->id,
                'new_price'  => (isset($data['new_price']) ? $data['new_price'] : ''),
                'old_price'  => (isset($data['old_price']) ? $data['old_price'] : ''),
                'sale'       => (isset($data['sale'])) ? $data['sale'] : 0,
                'name'       => (isset($data['name'])) ? $data['name'] : null
            ]);
    }

    public function save(array $data, $product)
    {
        $key = ((isset($data['key']) &&  $data['key'] != null) ? $data['key'] : null);
        $price = self::getModel()->firstOrNew(array('key'=>$key));
        $price->product_id = $product->id;
        $price->lot_id     = $product->lot_id;
        $price->new_price  = (isset($data['new_price']) ? $data['new_price'] : '');
        $price->old_price  = (isset($data['old_price']) ? $data['old_price'] : '');
        $price->sale       = (isset($data['sale'])) ? $data['sale'] : 0;
        $price->name       = (isset($data['name']) ? $data['name'] : ''); 
        $price->key        = (isset($data['key']) ? $data['key'] : '');
        $price->save();
        return $price;
    }

    public function update($spec, array $data)
    {
        $spec->fill([
            'size'       => isset($data['size']) ? $data['size'] : null,
            'color_hash' => isset($data['color']) ? $data['color'] : null,
            'amount'     => isset($data['sold']) ? $data['sold'] : null
        ]);
        
        $spec->save();
        
        return $spec;
    }
}