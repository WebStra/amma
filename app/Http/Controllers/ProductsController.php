<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Image;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Repositories\CategoryableRepository;
use App\Repositories\InvolvedRepository;
use App\Repositories\ProductsColorsRepository;
use App\Services\ImageProcessor;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Session\Store;
use App\Repositories\ProductsRepository;

class ProductsController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * @var CategoryableRepository
     */
    protected $categoryable;

    /**
     * @var Store
     */
    protected $session;

    /**
     * @var InvolvedRepository
     */
    protected $involved;

    /**
     * @var ProductsColorsRepository
     */
    protected $productsColors;

    /**
     * ProductsController constructor.
     * @param Store $session
     * @param ProductsRepository $productsRepository
     * @param CategoryableRepository $categoryableRepository
     * @param ProductsColorsRepository $productsColorsRepository
     */
    public function __construct(
        Store $session,
        ProductsRepository $productsRepository,
        CategoryableRepository $categoryableRepository,
        ProductsColorsRepository $productsColorsRepository,
        InvolvedRepository $involvedRepository
    )
    {
        $this->session = $session;
        $this->products = $productsRepository;
        $this->categoryable = $categoryableRepository;
        $this->productsColors = $productsColorsRepository;
        $this->involved = $involvedRepository;
    }

    /**
     * Show inner product.
     *
     * @param $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($product)
    {
        $view = view('product.show')->withItem($product);

        $same_products = $this->products->getSameProduct($product);

        if(Auth::check()) {
            $auth_is_involved = $this->involved
                ->checkIfAuthInvolved($product);

            return $view
                ->withUserIsInvolved($auth_is_involved)
                ->withInvolved($this->involved->getModelByUserAndProduct($product));
        }

        return $view
            ->withUserIsInvolved(false)
            ->withSame($same_products);
    }

    /**
     * Get create product form.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate($vendor)
    {
        $product = $this->createPlainProduct($vendor->id);

        $this->session->put('drafted_product', $product->id);

        return view('product.create', ['vendor' => $vendor, 'item' => $product]);
    }

    /**
     * @param ProductCreateRequest $request
     * @param \App\Vendor $vendor
     * @param \App\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSave(
        $request,
        $vendor = null,
        $product = null
    )
    {
        $product = $this->products->update(
            $product,
            $request->all()
        );

        if (!is_null($categories = $request->get('categories')))
            $this->saveCategories($categories, $product);

        if (!empty($spec = $request->get('spec')))
            $this->saveSpecifications($spec, $product);

        $this->clearProductFromSession();

        return redirect()->route('view_product', ['product' => $product->id]);
    }

    /**
     * @param $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditForm($product)
    {
        return view('product.edit', ['item' => $product]);
    }

    /**
     * Post create method action.
     *
     * @param ProductCreateRequest $request
     * @param $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(ProductCreateRequest $request, $vendor, $product)
    {
        return $this->postSave($request, null, $product);
    }

    /**
     * Post update method action.
     *
     * @param ProductUpdateRequest $request
     * @param $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateRequest $request, $product)
    {
        return $this->postSave($request, null, $product);
    }

    /**
     * Create plain product.
     *
     * @param $vendor_id
     * @return \App\Product
     */
    private function createPlainProduct($vendor_id)
    {
        return $this->products->create([
            'vendor_id' => $vendor_id,
            'status' => 'drafted',
            'active' => 0
        ]);
    }

    /**
     * Clean session from drafted products.
     *
     * @return void
     */
    private function clearProductFromSession()
    {
        $this->session->forget('drafted_product');
    }

    /**
     * @param $categories
     * @param $product
     */
    private function saveCategories($categories, $product)
    {
        array_walk($categories, function ($category_id) use ($product) {
            $category = $this->categoryable->find($category_id);

            if(! count($category))
            $this->categoryable->create((int)$category_id, $product);
        });
    }

    /**
     * @param $specifications
     * @param $product
     */
    private function saveSpecifications($specifications, $product)
    {
        array_walk($specifications, function ($meta) use ($product) {
            $product->setMeta($meta['key'], $meta['value'], 'spec');
        });
    }

    /**
     * Add image to product.
     *
     * @param Request $request
     * @param $product
     * @return mixed
     * @throws \Exception
     */
    public function addImage(Request $request, $product)
    {
        $image = $request->file('file');

        if ($image instanceof UploadedFile) {
            $location = 'upload/products/' . $product->id;
            $processor = new ImageProcessor();
            $imageable = $processor->uploadAndCreate($image, $product, null, $location);
        } else {
            throw new \Exception('Invalid Image');
        }

        return $imageable;
    }

    /**
     * @ajax Remove Image.
     *
     * @param Request $request
     * @param $product
     */
    public function removeImage(Request $request, $product)
    {
        Image::find($request->get('image_id'))->delete();
    }

    /**
     * @ajax Save image order.
     *
     * @param Request $request
     * @param $product
     */
    public function saveImagesOrder(Request $request, $product)
    {
        $sorted = $request->get('item');

        $newsort = [];
        array_walk($sorted, function ($id, $k) use (&$newsort){
            $image = Image::find($id);

            $newsort[$k] = ['id' => $image->id, 'rank' => $image->rank];
        });

        $oldsort = [];
        $product->images()->ranked('asc')->get()->each(function ($item, $k) use(&$oldsort)
        {
            $oldsort[$k] = ['id' => $item->id, 'rank' => $item->rank];
        });

        $this->setNewRankToChangedPositions(
            $this->getChangedSortPositions($newsort, $oldsort),
            $newsort,
            $oldsort
        );
    }

    /**
     * @ajax Add color to product.
     *
     * @param Request $request
     * @param $product
     * @return static
     */
    public function addColor(Request $request, $product)
    {
        if (!$this->productsColors->hasColor($product, $request->get('color')))
            return $this->productsColors
                ->create($product, $request->get('color'));
    }

    /**
     * @ajax Remove color.
     *
     * @param Request $request
     * @param $product
     * @return void
     */
    public function removeColor(Request $request, $product)
    {
        $this->productsColors->delete($request->get('color_id'));
    }

    /**
     * @ajax Remove spec.
     *
     * @param Request $request
     * @param $product
     * @return void
     */
    public function removeSpec(Request $request, Product $product)
    {
        $product->removeMetaById($request->get('id'));
    }

    /**
     * Get only changed positions of sorted elements.
     *
     * @param $newsort
     * @param $oldsort
     * @return array
     */
    private function getChangedSortPositions($newsort, $oldsort)
    {
        $temp = [];
        array_walk($newsort, function ($sorted_attribs, $position) use ($oldsort, $newsort, &$temp)
        {
            if($oldsort[$position]['id'] !== $newsort[$position]['id'])
            {
                $temp[] = $position;
            }
        });

        return $temp;
    }

    /**
     * Save sorted ranks to changed positions.
     *
     * @param $changed_positions
     * @param $newsort
     * @param $oldsort
     */
    private function setNewRankToChangedPositions($changed_positions, $newsort, $oldsort)
    {
        array_walk($changed_positions, function ($position) use ($oldsort, $newsort)
        {
            $image = Image::find($newsort[$position]['id']);

            $image->setRank($oldsort[$position]['rank']);
        });
    }
}