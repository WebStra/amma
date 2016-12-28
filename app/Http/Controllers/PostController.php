<?php

namespace App\Http\Controllers;

use Event;
use App\Events\PostWasViewed;
use App\Repositories\PostsRepository;

class PostController extends Controller
{
    /**
     * @var PostsRepository
     */
    protected $posts;

    /**
     * PostController constructor.
     * @param PostsRepository $postsRepository
     */
    public function __construct(PostsRepository $postsRepository)
    {
        $this->posts = $postsRepository;
    }

    /**
     * Index blog page.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = $this->posts->getPublic(5);

        return view('blog.index')->with('posts', $posts);
    }

    /**
     * Single post view.
     *
     * @param \App\Post $post
     * @return \Illuminate\View\View
     */
    public function show($post)
    {
        Event::fire(new PostWasViewed($post));

        $post  = $this->posts->find($post->id);
        
        return view('blog.post')->withItem($post);
    }
}