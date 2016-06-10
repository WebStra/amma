<?php

namespace App\Http\Controllers;

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
        $posts = $this->posts->getPublic();

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
        return view('blog.post')->with('post', $post);
    }
}