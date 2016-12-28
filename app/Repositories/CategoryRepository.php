<?php

namespace App\Repositories;

use App\Category;
use App\Libraries\Categoryable\Categoryable;

class CategoryRepository extends Repository
{
    /**
     * @return Category
     */
    public function getModel()
    {
        return new Category();
    }

    /**
     * Create a record in categories table.
     *
     * @param array $data
     * @return Category
     */
    public function create(array $data)
    {
        return self::getModel()
            ->create($data);
    }

    /**
     * Get active rows.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublic()
    {
        return self::getModel()
            ->active()
            ->get();
    }

    /**
     * Get category collection for sidebar.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSidebarCollection()
    {
       return self::getModel()
           ->where('show_in_sidebar', 1)
           ->active()
           ->ranked()
           ->get();
    }

    /**
     * Get category collection for footer.
     *
     * @param $take
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFooterCollection($take = 7)
    {
        return self::getModel()
            ->where('show_in_footer', '=', 1)
            ->active()
            ->ranked()
            ->take($take)
            ->get();
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

    /**
     * Get parent categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublicCategories()
    {
        return $this->getSidebarCollection();
    }

    /**
     * Get popular category.
     *
     * @return mixed
     */
    public function getPopularCategory()
    {
        return $this->getModel()
            ->select('*')
            ->where(
                'id',
                settings()->getOption(
                    'homepage::popular_category',
                    'value'
                )
            )
            ->active()
            ->first();
    }

}