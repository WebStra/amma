<?php

namespace App\Repositories;

use App\Product;
use App\Involved;
use App\Lot;
use Carbon;
use Illuminate\Support\Facades\Auth;

class InvolvedRepository extends Repository
{
    /**
     * @return Involved
     */
    public function getModel()
    {
        return new Involved();
    }

    /**
     * Involve the product offer
     *
     * @param array $data
     * @param Product $product
     * @return Involved
     */
    public function create(array $data, $product)
    {
        return $this->getModel()
            ->create([
                'user_id' => \Auth::id(),
                'product_id' => $product->id,
                'lot_id' => $product->lot_id,
                'count' => isset($data['count']) ? $data['count'] : 1
            ]);
    }

    /**
     * Update involve status.
     * 
     * @param Involved $involve
     * @param array $data
     * @return $this
     */
    public function update(Involved $involve, array $data)
    {
        $involved = $involve->fill([
            'active' => (isset($data['active'])) ? $data['active'] : $involve->active,
            'count' => (isset($data['count'])) ? $data['count'] : $involve->count
        ]);

        $involved->save();

        return $involved;
    }

    /**
     * Check if auth-cate user is involved to this product.
     * 
     * @param Product $product
     * @return bool
     */
    public function checkIfAuthInvolved(Product $product)
    {
        $model = $this->getModelByUserAndProduct($product);

        return (bool) $model;
    }

    /**
     * @param array $data
     * @param $product
     * @return Involved|InvolvedRepository
     */
    public function createOrUpdate(array $data, $product)
    {
        if($this->checkIfAuthInvolved($product))
            return $this->update($product, $data);
        
        return $this->create($data, $product);
    }

    /**
     * @param $product
     * @param null $user
     * @param bool $active
     * @return mixed
     */
    public function getModelByUserAndProduct($product, $user = null, $active = true)
    {
        return $this->getModel()
            ->where('user_id', ($user) ? $user : Auth::id())
            ->where('product_id', $product->id)
            ->active($active)
            ->first();
    }

    /**
     * @param $product
     * @param bool $active
     * @return mixed
     */
    public function getModelsByUserAndProduct($product, $active = true)
    {
        return $this->getModel()
            ->where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->active($active)
            ->get();
    }

    /**
     * Count rules.
     * 
     * @return string
     */
    public function countRules()
    {
        return 'numeric|min:1';
    }

    /**
     * @param $product
     * @return int
     */
    public function getInvolveTimesProduct($product)
    {
        return count($this->getModelsByUserAndProduct($product, true));
    }

    public function getCountSelled($id)
    {
        return $this->getModel()
            ->where('product_id', $id)
            ->active()
            ->sum('count');
    }

    public function getInvolvedProductforUser() {

        return  $this->getModel()
                ->active()
                ->where('user_id',\Auth::user()->id)
                ->get();


    }

}