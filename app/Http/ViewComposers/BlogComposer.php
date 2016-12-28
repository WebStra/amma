<?php

namespace App\Http\ViewComposers;

use App\Repositories\PostsRepository;
use Illuminate\Contracts\View\View;

class BlogComposer extends Composer
{
    /**
     * @var PostsRepository
     */
    protected $posts;

    /**
     * BlogComposer constructor.
     * @param PostsRepository $postsRepository
     */
    public function __construct(PostsRepository $postsRepository)
    {
        $this->posts = $postsRepository;
    }

    /**
     * Bind view to data.
     *
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        $posts = $this->posts->getPopularPublic();

        return $view->with('posts', $posts);
    }
}