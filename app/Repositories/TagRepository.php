<?php

namespace App\Repositories;

use App\Category;
use App\SubCategory;
use App\Tag;

class TagRepository extends Repository
{
    const DYNAMIC_FILTER_SEPARATOR = '_x_';
    
    /**
     * Render dynaimc filter's name.
     *
     * @param $group
     * @param $name
     *
     * @return string
     */
    public static function renderDynamicFilterName($group, $name)
    {
        return sprintf("%s%s%s", str_slug($group), self::DYNAMIC_FILTER_SEPARATOR, str_slug($name));

//        return strtolower(sprintf("%s_%s", $group, str_replace(' ', '_', $name)));
    }

    /**
     * Get constant DYNAMIC_FILTER_SEPARATOR
     * 
     * @return string
     */
    public function getDynamicFilterSeparator()
    {
        return self::DYNAMIC_FILTER_SEPARATOR;
    }

    /**
     * @return Tag
     */
    public function getModel()
    {
        return new Tag();
    }

    /**
     * @return \App\TagTranslation
     */
    private function translatableModel()
    {
        $translatableModel = $this->getModel()->translationModel;

        return (new $translatableModel);
    }

    /**
     * Get tag groups.
     *
     * @param Category $category | null
     * @param SubCategory $sub_category | null
     * @param $flip bool Flip the array
     * @return array
     */
    public function getCategoryTagGroups($category = null, $sub_category = null, $flip = false)
    {
        $query = $this->getModel()
            ->select('*')
            ->translated();

        if($category)
        {
            if($category instanceof Category)
                $query->where('category_id', $category->id);

            if($sub_category instanceof SubCategory)
            {

            }
        }

//        if($category)
//            $query->where('category_id', $category->id);

        $mixed_groups = $query
            ->active()
            ->pluck('group')
            ->toArray();

        $groups = [];
        array_walk($mixed_groups, function($group, $id) use (&$groups) {
            if(! empty($group))
                $groups[$id] = $group;
        });

        if($flip)
            return array_flip($groups);

        return array_flip(array_flip($groups));
    }

    /**
     * Get available dynamic filters.
     *
     * @param $category
     * @return array
     */
    public function getAvailableDynamicFilters($category)
    {
        $groups = $this->getCategoryTagGroups($category);
        $available_filters = [];

        array_walk($groups, function($group) use (&$available_filters, $category){
            $tags = $category->tags()
                ->select('*')
                ->translated()
                ->whereGroup($group)
                ->active()
                ->get();

            if(count($tags))
                $tags->each(function($tag) use (&$available_filters, $group){
//                    $available_filters[strtolower($group)][] = str_replace(' ', '_', $tag->normalized);
                    $available_filters[str_slug($group)][] = str_slug($tag->normalized);
                });
        });

        return $available_filters;
    }
}