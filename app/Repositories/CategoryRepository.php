<?php

namespace App\Repositories;

use App\Category;
use App\CategoryTranslation;
use App\Contracts\TranslatableRepositoryContract;
use App\Libraries\Categoryable\Categoryable;

class CategoryRepository extends Repository implements TranslatableRepositoryContract
{
    /**
     * @return Category
     */
    public function getModel()
    {
        return new Category();
    }

    /**
     * @return CategoryTranslation
     */
    public function getTranslatableModel()
    {
        return new CategoryTranslation();
    }

    /**
     * @return Categoryable
     */
    public function getCategoryableModel()
    {
        return new Categoryable();
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
     * @return \Illuminate\Database\Eloquent\Collection;
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
           ->parent()
           ->active()
           ->ranked()
           ->get();
    }

    /**
     * Get category collection for footer.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFooterCollection()
    {
        return self::getModel()
            ->where('show_in_footer', '=', 1)
            ->parent()
            ->active()
            ->ranked()
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
}