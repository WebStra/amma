<?php

namespace App\Repositories;

use App\SubCategory;

class SubCategoriesRepository extends Repository
{
    /**
     * @return SubCategory
     */
    public function getModel()
    {
        return new SubCategory();
    }

    /**
     * Get row by translated slug.
     *
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug)
    {
        return self::getModel()
            ->select('*')
            ->translated()
            ->whereSlug($slug)
            ->first();
    }
}