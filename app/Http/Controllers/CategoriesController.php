<?php

namespace App\Http\Controllers;

use App\Category;
use App\Lot;
use App\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     *
     */
    const FILTER_DYNAMIC = 'dynamic';

    /**
     *
     */
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
     * Get list of unchanged/static filters.
     *
     * @return array
     */
    final static public function getStaticFilters()
    {
        return [ 'price_min', 'price_max' ];
    }

    /**
     * Show action for category.
     *
     * @param Request $request
     * @param $category
     * @param $subcategory
     *
     * @return $this
     */
    public function show(Request $request, $category, $subcategory = null)
    {

        $groups = $this->tags->getCategoryTagGroups($category, $subcategory);

        $filtered = $this->applyFilter($request, $category, $subcategory, 12);

        return view(($request->ajax()) ? 'categories.partials.filter_result' : 'categories.index', [
            'category' => $category, 'products' => $filtered, 'groups' => $groups
        ]);
    }

    /**
     * Apply filters for category scope.
     *
     * @param Request $request
     * @param $category
     * @param $subcategory
     * @param $perPage
     *
     * @return mixed
     */
    protected function applyFilter(Request $request, $category, $subcategory, $perPage = 12)
    {
        if($filters = $request->all() ? : false)
            list($static, $dynamic) = $this->separateFilters($filters);

        $query = $category->products()
            ->getQuery()->select('products.*');

        if(isset($static) && $static = $this->clearStaticFilters($static))
            $query = $this->applyStaticFilter($query, $static);

        if(isset($dynamic) && $dynamic = $this->clearDynamicFilters($dynamic, $category))
            $query = $this->applyDynamicFilter($query, $dynamic);

        $query->join('lots', 'lots.id', '=', 'products.lot_id')
            ->where('lots.status', Lot::STATUS_COMPLETE)
            ->where('lots.verify_status', Lot::STATUS_VERIFY_ACCEPTED);

        if($subcategory)
        {
            // todo: fix it, subcategory don;t incoming..
            $query = $query->where('products.sub_category_id', $subcategory->id);
//          $query->where('products.sub_category_id', $subcategory->id);
        }


        return $query->where('products.active', 1)->paginate($perPage);
    }

    /**
     * Apply static filters.
     *
     * @param $query
     * @param array|null $filters
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyStaticFilter($query, array $filters = null)
    {
        /** Price range static filter. */
        if(isset($filters['price_min']) && isset($filters['price_max']))
        {
            $query->where(function($q) use ($filters){
                $q->whereBetween('products.price', array($filters['price_min'], $filters['price_max']));
            });
        }
        return $query;
    }

    /**
     * Apply static filters.
     *
     * @param $query
     * @param array|null $filters
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyDynamicFilter($query, array $filters = null)
    {
        $tags = '';
        $i = 1;
        $dynamic_count = count($filters);
        array_walk($filters, function($filter_val, $filter) use (&$query, &$tags, $filters, $dynamic_count, &$i){
            list($group, $tag) = $this->parseDynamicFilter($filter);
            if($i !== $dynamic_count)
            {
                $tags .= sprintf('%s,', $tag);
            } else {
                $tags .= $tag;
            }

            $i++;
        });

        /**
         * Query tags scopes..
         *
         * Model::withAllTags('apple,banana,cherry');
         *  - returns models that are tagged with all 3 of those tags
         *
         * Model::withAnyTags('apple,banana,cherry');
         *  - returns models with any one of those 3 tags
         *
         * Model::withAnyTags();
         * - returns models with any tags at all
         *
         * @attention: for more info. check https://github.com/cviebrock/eloquent-taggable docs.
         */
        $query->withAllTags($tags);

        return $query;
    }

    /**
     * Clear static filters.
     *
     * @param $filters
     *
     * @return array|null
     */
    protected function clearStaticFilters($filters)
    {
        $available_filters = array_flip($this->getStaticFilters());

        $filters = array_filter($filters, function($filter_v, $filter_k) use ($available_filters){
            return isset($available_filters[$filter_k]);
        }, ARRAY_FILTER_USE_BOTH);

        return (!empty($filters)) ? $filters : null;
    }

    /**
     * Clean dynamic filters.
     *
     * @param $filters
     * @param \App\Category $category
     *
     * @return array|null
     */
    protected function clearDynamicFilters($filters, $category)
    {
        $available_filters = $this->tags->getAvailableDynamicFilters($category);

        $filters = array_filter($filters, function($filter) use ($available_filters){
            if($this->isDynamicFilter($filter))
            {
                list($group, $tag) = $this->parseDynamicFilter($filter);

                if (isset($available_filters[$group]))
                    return in_array($tag, $available_filters[$group]);
            }
        }, ARRAY_FILTER_USE_KEY);

        return (!empty($filters)) ? $filters : null;
    }

    /**
     * Separate filters.
     *
     * @param $filters
     *
     * @return array
     */
    protected function separateFilters($filters)
    {
        $static_filters = $this->getStaticFilters();

        $static = [];
        $dynamic = $filters;
        array_walk($static_filters, function($static_filter) use (&$static, &$dynamic){
            if(isset($dynamic[$static_filter]))
            {
                $static[$static_filter] = $dynamic[$static_filter];

                unset($dynamic[$static_filter]);
            }
        });

        return [ $static, $dynamic ];
    }

    /**
     * Parse dynamic filter. First element must be an a group,
     * and the second is a tag.
     *
     * @param $filter
     *
     * @return array
     */
    public function parseDynamicFilter($filter)
    {
        $separator = $this->tags->getDynamicFilterSeparator();

        list($group, $tag) = explode($separator, $filter, 2);

        return [ $group, $tag ];
    }

    /**
     * Check if first argument is dynamic filter.
     * (todo: rework it. hardcoded)
     *
     * @param $filter
     * @return bool
     */
    public function isDynamicFilter($filter)
    {
        $separator = $this->tags->getDynamicFilterSeparator();

        $result = explode($separator, $filter, 2);

        return count($result) == 2;
    }
}