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

    public function save(array $data, $product)
    {

        $insert = [
            'product_id' => 624,
            'lot_id'     => 56,
            'new_price'  => 200,
            'old_price'  => 1000,
            'sale'       => 40
        ];

        //dd($data);
        dd(self::getModel()->firstOrNew(array('id'=>64))->save($insert));
        return self::getModel()->save($insert);
        //$price->save($insert);

/*        return self::getModel()
            ->save([
                'product_id' => $product->id,
                'lot_id'     => $product->lot_id,
                'new_price'  => (isset($data['new_price']) ? $data['new_price'] : ''),
                'old_price'  => (isset($data['old_price']) ? $data['old_price'] : ''),
                'sale'       => (isset($data['sale'])) ? $data['sale'] : 0
            ]);*/
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