<?php

namespace App\Listeners;

use App\Events\PostWasViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Session\Store;
use App\Repositories\PostsRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class ViewPostHandler implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var PostsRepository
     */
    protected $posts;

    /**
     * @var Store
     */
    private $session;

    /**
     * ViewPostHandler constructor.
     * @param PostsRepository $postsRepository
     * @param Store $session
     */
    public function __construct(PostsRepository $postsRepository, Store $session)
    {
        $this->posts = $postsRepository;
        $this->session = $session;
    }

    /**
     * Handle event listener.
     *
     * @param PostWasViewed $event
     * @return \App\Post
     */
    public function handle(PostWasViewed $event)
    {
        $post = $event->getPost();
        
        if ( ! $this->isPostViewed($post))
        {
            $this->posts->incrementViewCount($post);

            $this->storePost($post);
        }

        return $post;
    }

    /**
     * Check if post was viewed user.
     *
     * @param $post
     * @return bool
     */
    private function isPostViewed($post)
    {
        $viewed = $this->session->get('viewed_posts', []);

        return array_key_exists($post->id, $viewed);
    }

    /**
     * Push item to session as viewed post.
     *
     * @param $post
     * @return void.
     */
    private function storePost($post)
    {
        $key = 'viewed_posts.' . $post->id;

        $this->session->put($key, time());
    }
}