<?php

namespace App\Listeners\Observers;

use App\Repositories\TaggableSubCategoriesRepository;
use App\TaggableSubCategory;
use Request;
use Cviebrock\EloquentTaggable\Services\TagService;

class TagObserver extends Observer
{

    /**
     * On saving tag runs this event.
     *
     * @param $model
     *
     * @return mixed
     */
    public function saving($model)
    {
        return $this->generateNormalize($model);
    }

//    public function saved($model)
//    {
//        $subCategories = Request::get('sub_categories');
//
//        if(count($subCategories))
//        {
//            $this->addSubCategories($model, $subCategories);
//        }
//
//        return $model;
//    }

    /**
     * Generate normalized field from original name (default locale).
     *
     * @param $model
     *
     * @return mixed
     */
    public function generateNormalize($model)
    {
        $model->normalized = $this->normalize($model->name);

        return $model;
    }

    /**
     * Normalize a string.
     *
     * @param string $string
     *
     * @return mixed
     */
    public function normalize($string)
    {
        return app(TagService::class)->normalize($string);
    }

    /**
     * Add subcategories for tags.
     *
     * @param $model
     * @param $subCategories
     *
     * @return void
     */
    private function addSubCategories($model, $subCategories)
    {
//        $this->getTaggableSubCategoryRepository()->firstOrCreate([
//            'tag_id' => $model->id,
//            'sub_category_id' => $subCategory
//        ]);
    }

    /**
     * @return TaggableSubCategoriesRepository
     */
    private function getTaggableSubCategoryRepository()
    {
        return (new TaggableSubCategoriesRepository);
    }
}