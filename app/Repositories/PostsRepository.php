<?php

namespace App\Repositories;

use App\Post;
use App\PostTranslation;

class PostsRepository extends Repository
{
    /**
     * @return Post
     */
    public function getModel()
    {
        return new Post();
    }

    /**
     * @return PostTranslation
     */
    public function getTranslatableModel()
    {
        return new PostTranslation();
    }

    /**
     * Get public posts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublic()
    {
        return self::getModel()
            ->published()
            ->active()
            ->orderBy('id', self::DESC)
            ->get();
    }

    /**
     * Get popular public posts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPopularPublic()
    {
        // todo: popular featured posts.
       return $this->getModel()
           ->published()
           ->active()
           ->take(4)
           ->get();
    }

    /**
     * Get post by slug.
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
            ->published()
            ->active()
            ->first();
    }
}