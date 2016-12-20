<?php

namespace App\Repositories;

use App\ImprovedSpec;

class ImprovedSpecRepository extends Repository
{
    /**
     * @return ImprovedSpec
     */
    public function getModel()
    {
        return new ImprovedSpec();
    }

    /**
     * @param $product_id
     * @return static
     */
    public function createPlain($product_id, $spec_id = null)
    {
        $insert = array('product_id' => (int)$product_id);
        if ($spec_id != null) {
            $insert['price_spec_id'] = (int)$spec_id;
        }
        return self::getModel()
            ->create($insert);
    }

    /**
     * Find model by id/slug.
     *
     * @param $id
     * @return ImprovedSpec
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
     * @param ImprovedSpec $model
     */
    public function delete(ImprovedSpec $model)
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
    public function create(array $data, $specSize)
    {
        return self::getModel()
            ->create([
                'product_id'    => $specSize->product_id,
                'price_spec_id' => $specSize->id,
                'size'          => (isset($data['size'])) ? $data['size'] : null
            ]);
    }
    public function update($spec, array $data)
    {
        $spec->fill([
            'size' => isset($data['size']) ? $data['size'] : null,
            'color_hash' => isset($data['color']) ? $data['color'] : null,
            'amount' => isset($data['sold']) ? $data['sold'] : null
        ]);
        
        $spec->save();
        
        return $spec;
    }
}