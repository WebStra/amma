<?php

namespace App\Repositories;

use App\Category;
use App\Tag;

class TagRepository extends Repository
{
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
     * @param $flip bool Flip the array
     * @return array
     */
    public function getCategoryTagGroups(Category $category = null, $flip = false)
    {
        $query = $this->getModel()
            ->select('*')
            ->translated();

        if($category)
            $query->where('category_id', $category->id);

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
                    $available_filters[$group][] = $tag->name;
                });
        });

        return $available_filters;
    }
}