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
    public function __construct(CategoryRepository $categoryRepository, ProductsRepository $productsRepository)
    {
        $this->categories = $categoryRepository;
        $this->products = $productsRepository;
    }

    /**
     * Show action for category.
     * 
     * @param Category $category
     * @return $this
     */
    public function show($category)
    {
        return view('categories.index')->with('category', $category);
    }
}