<?php

namespace App\Repositories;

use App\TaggableSubCategory;

class TaggableSubCategoriesRepository extends Repository
{
    public function getModel()
    {
        return new TaggableSubCategory();
    }

    /**
     * First of create records.
     *
     * @param array $data
     * @return mixed
     */
    public function firstOrCreate(array $data)
    {
        return self::getModel()
            ->firstOrCreate([
                'taggable_tag_id' => $data[ 'tag_id' ],
                'sub_category_id' => $data[ 'sub_category_id' ]
            ]);
    }
}