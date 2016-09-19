<?php

namespace App\Http\Controllers;

use App\Category;
use App\Libraries\Categoryable\Categoryable;
use App\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    const FILTER_DYNAMIC = 'dynamic';

    const FILTER_STATIC = 'static';

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

        $products = $category->categoryables()->elementType(Product::class)->get();

        return view('categories.index', [
            'category' => $category,
            'groups' => $groups,
            'products' => $products
        ]);
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

        $filtered = $this->applyFilter([ self::FILTER_STATIC => $static, self::FILTER_DYNAMIC => $dynamic ], $category);

        return view('categories.partials.filter_result', [ 'category' => $category, 'products' => $filtered ]);
    }

    /**
     * Apply filters for category scope.
     *
     * @param null $filters
     * @param Category $category
     * @return mixed
     */
    protected function applyFilter($filters = null, Category $category)
    {
        $static = $filters[self::FILTER_STATIC];
        $dynamic = $filters[self::FILTER_DYNAMIC];
        $query = $category->categoryables()
            ->elementType(Product::class);

        if(! empty($dynamic))
        {
            $tags = '';
            $i = 0;
            $dynamic_count = count($dynamic);
            array_walk($dynamic, function($filter_val, $filter) use (&$query, &$tags, $dynamic, $dynamic_count, &$i){
                list($group, $tag) = $this->parseDynamicFilter($filter);

                $i == $dynamic_count ? $tags .= sprintf('%s,', $tag) : $tags .= $tag;

//                $query->whereGroup($group);
                $i++;
            });

            $query->withAllTags($tags);
        }

        return $query
            ->active()
            ->get();
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
            list($group, $tag) = $this->parseDynamicFilter($filter);

            $group = ucfirst($group); // todo: this stuff is hardcoded, find better solution ..

            return in_array($tag, $available_filters[$group]);
        }, ARRAY_FILTER_USE_KEY);

        return $filters;
    }

    /**
     * Parse dynamic filter. First element must be an a group,
     * and the second is a tag.
     *
     * @param $filter
     * @param string $separator
     * @return array
     */
    public function parseDynamicFilter($filter, $separator = '_')
    {
        list($group, $tag) = explode($separator, $filter);

        $group = ucfirst($group);

        return [ $group, $tag ];
    }
}