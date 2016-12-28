<?php

namespace App\Repositories;

use App\Libraries\Categoryable\Categoryable;

/**
 * Class CategoryableRepository
 * @package App\Repositories
 */
class CategoryableRepository extends Repository
{
    /**
     * @return Categoryable
     */
    public function getModel()
    {
        return new Categoryable();
    }

    /**
     * @param $category
     * @param $categoryable
     * @return Categoryable
     */
    public function create($category, $categoryable)
    {
        return self::getModel()
            ->create([
                'categoryable_id' => $categoryable->id,
                'categoryable_type' => get_class($categoryable),
                'category_id' => is_numeric($category) ? $category : $category->id
            ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByCategoryId($id)
    {
        return self::getModel()
            ->where('category_id', $id)
            ->active()
            ->first();
    }

    /**
     * @param $product
     * @param $category_id
     * @return mixed
     */
    public function getByProductAndCategoryId($product, $category_id)
    {
        return self::getModel()
            ->where('categoryable_id', $product->id)
            ->where('categoryable_type', get_class($product))
            ->where('category_id', $category_id)
            ->first();
    }
}