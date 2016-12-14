<?php

namespace App\Repositories;

use App\SpecPrice;

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
    public function delete(SpecPrice $model)
    {
        $model->delete();
    }

    /**
     * Update suite of improved specs.
     * 
     * @param $spec
     * @param array $data
     * @return mixed
     */
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