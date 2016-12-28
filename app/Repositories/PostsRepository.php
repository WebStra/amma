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
     * @param $perPage
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublic($perPage = 7)
    {
        return self::getModel()
            ->published()
            ->active()
            ->orderBy('id', self::DESC)
            ->paginate($perPage);
    }

    /**
     * Get popular public posts.
     *
     * @param int $count
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPopularPublic($count = 4)
    {
        // todo: popular featured posts.
       return $this->getModel()
           ->published()
           ->active()
           ->orderBy('view_count', self::DESC)
           ->orderBy('id', self::DESC)
           ->take($count)
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

    /**
     * Increment view_counter by 1.
     *
     * @param Post $post
     */
    public function incrementViewCount($post)
    {
        $post->increment('view_count');
    }
}