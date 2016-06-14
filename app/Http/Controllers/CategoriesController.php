<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductsRepository;

class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * CategoriesController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categories = $categoryRepository;
    }

    /**
     * Show action for category.
     * 
     * @param Category $category
     * @return $this
     */
    public function show($category)
    {
        return view('categories.index', compact('category'));
    }
}