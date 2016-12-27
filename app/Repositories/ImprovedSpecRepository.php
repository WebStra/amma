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

    public function findKey($key)
    {
        return $this->getModel()
            ->whereKey($key)
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

    public function getById($id) {
        return $this->getModel()
            ->where('price_spec_id',(int)$id)
            ->get();
    }

    /**
     * Update suite of improved specs.
     * 
     * @param $spec
     * @param array $data
     * @return mixed
     */
    public function create(array $data, $specPrice)
    {
        return self::getModel()
            ->create([
                'product_id'    => $specPrice->product_id,
                'price_spec_id' => $specPrice->id,
                'size'          => (isset($data['size'])) ? $data['size'] : null
            ]);
    }

    public function save(array $data, $specPrice)
    {
        $key = ((isset($data['key']) &&  $data['key'] != null) ? $data['key'] : null);
        $size                = self::getModel()->firstOrNew(array('key'=>$key));
        $size->product_id    = $specPrice->product_id;
        $size->price_spec_id = $specPrice->id;
        $size->size          = (isset($data['size'])) ? $data['size'] : '';
        $size->key           = (isset($data['key']) ? $data['key'] : '');
        $size->save();
        return $size;
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