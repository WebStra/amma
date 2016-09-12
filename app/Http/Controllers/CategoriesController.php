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

    /**
     * Filter categories.
     *
     * @param Request $request
     * @param $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter(Request $request, $category)
    {
        $filters = $request->all();

        list($static, $dynamic) = $this->separateFilters($filters);

        $dynamic = $this->clearDynamicFilters($dynamic, $category);

        $filtered = $this->applyFilter([ $static, $dynamic ]);

        return view('categories.partials.filter_result', [ 'category' => $filtered ]);
    }

    /**
     * Apply filters for category scope.
     *
     * @param null $filters
     * @return mixed
     */
    protected function applyFilter($filters = null)
    {
        //
    }

    /**
     * Separate filters.
     *
     * @param $filters
     * @return array
     */
    protected function separateFilters($filters)
    {
        $static_filters = $this->getStaticFilters();

        $static = [];
        $dynamic = $filters;
        array_walk($static_filters, function($static_filter) use (&$static, &$dynamic){
            $static[$static_filter] = $dynamic[$static_filter];

            unset($dynamic[$static_filter]);
        });

        return [ $static, $dynamic ];
    }

    /**
     * Get list of unchanged/static filters.
     *
     * @return array
     */
    final static public function getStaticFilters()
    {
        return [ 'price_min', 'price_max' ];
    }

    /**
     * Clean dynamic filters.
     *
     * @param $filters
     * @param \App\Category $category
     * @return array
     */
    protected function clearDynamicFilters($filters, $category)
    {
        $available_filters = $this->tags->getAvailableDynamicFilters($category);

        $filters = array_filter($filters, function($filter) use ($available_filters){
            list($group, $tag) = explode('_', $filter);

            $group = ucfirst($group); // todo: this stuff is hardcoded, find better solution ..

            return in_array($tag, $available_filters[$group]);
        }, ARRAY_FILTER_USE_KEY);

        return $filters;
    }
}