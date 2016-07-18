<?php

namespace App\Repositories;

use App\Libraries\Categoryable\Categoryable;

class CategoryableRepository extends Repository
{
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
}