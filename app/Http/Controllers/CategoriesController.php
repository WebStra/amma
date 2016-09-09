<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * @var TagRepository
     */
    protected $tags;

    /**
     * CategoriesController constructor.
     * @param CategoryRepository $categoryRepository
     * @param TagRepository $tagRepository
     */
    public function __construct(CategoryRepository $categoryRepository, TagRepository $tagRepository)
    {
        $this->categories = $categoryRepository;
        $this->tags = $tagRepository;
    }

    /**
     * Show action for category.
     * 
     * @param Category $category
     * @return $this
     */
    public function show($category)
    {
        $groups = $this->tags->getCategoryTagGroups($category);

        return view('categories.index', [ 'category' => $category, 'groups' => $groups ]);
    }

    public function filter(Request $request) // todo: cahnge method name..
    {
        // todo: send content here ..
        return view('test');
    }
}