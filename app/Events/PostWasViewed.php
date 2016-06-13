<?php

namespace App\Events;

use App\Post;
use Illuminate\Queue\SerializesModels;

class PostWasViewed extends Event
{
    use SerializesModels;

    /**
     * @var Post
     */
    public $post;

    /**
     * PostWasViewed constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get post model.
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }
}