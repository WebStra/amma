<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\SaveProductRequest;
use App\Image;
use App\ImprovedSpec;
use App\Lot;
use App\Repositories\ImprovedSpecRepository;
use App\Repositories\LotRepository;
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
     * @var LotRepository
     */
    protected $lots;

    /**
     * @var ImprovedSpec
     */
    protected $improvedSpecs;

    /**
     * ProductsController constructor.
     * @param Store $session
     * @param ProductsRepository $productsRepository
     * @param CategoryableRepository $categoryableRepository
     * @param ProductsColorsRepository $productsColorsRepository
     * @param InvolvedRepository $involvedRepository
     * @param LotRepository $lotRepository
     * @param ImprovedSpecRepository $improvedSpecRepository
     */
    public function __construct(
        Store $session,
        ProductsRepository $productsRepository,
        CategoryableRepository $categoryableRepository,
        ProductsColorsRepository $productsColorsRepository,
        InvolvedRepository $involvedRepository,
        LotRepository $lotRepository,
        ImprovedSpecRepository $improvedSpecRepository
    )
    {
        $this->session = $session;
        $this->products = $productsRepository;
        $this->categoryable = $categoryableRepository;
        $this->productsColors = $productsColorsRepository;
        $this->involved = $involvedRepository;
        $this->lots = $lotRepository;
        $this->improvedSpecs = $improvedSpecRepository;
    }

    /**
     * @param SaveProductRequest $request
     * @param Product $product
     * @return mixed
     */
    public function save(SaveProductRequest $request, Lot $lot, Product $product)
    {
        $product = $this->products->saveProduct($product, $request->all());

        if (!empty($spec = $request->get('spec')))
            $this->saveSpecifications($spec, $product);

        if (!empty($fileInput = $request->file('image')))
            array_walk($fileInput, function($image) use (&$product){
                $this->addImage($image, $product);
            });

        if (!empty($specs = $request->get('i_spec')))
            $this->saveImprovedSpecifications($specs, $product);

        return view('lots.partials.form.product', [ 'lot' => $lot, 'product' => $product ]);
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
     * Delete products..
     *
     * @param Request $request
     * @param Lot $lot
     *
     * @return string
     */
    public function remove(Request $request, Lot $lot)
    {
        $this->products->delete($request->get('product_id'));

        if($this->lots->checkIfPossibleToChangeCategory($lot))
            return 'enable_cat';
    }

    /**
     * Save specifications.
     *
     * @param $specifications
     * @param $product
     */
    private function saveSpecifications($specifications, Product $product)
    {
        array_walk($specifications, function ($meta) use ($product) {
            $product->setMeta($meta['key'], $meta['value'], 'spec');
        });
    }

    private function saveImprovedSpecifications($specs, $product)
    {
        array_walk($specs, function($data, $spec_id){
            $spec = $this->improvedSpecs->find($spec_id);
            
            if($spec)
                $this->improvedSpecs->update($spec, $data);
        });
    }

    /**
     * Remove spec.
     *
     * @param Request $request
     *
     * @return void
     */
    public function removeSpec(Request $request)
    {
        $product = $this->products->find($request->get('product_id'));

        $product->removeMetaById($request->get('spec_id'));
    }

    /**
     * Remove improved spec.
     *
     * @param Request $request
     * @param Lot $lot
     *
     * @return void
     */
    public function removeImproveSpec(Request $request, Lot $lot)
    {
        $spec = $this->improvedSpecs->find($request->get('spec_id'));

        $this->improvedSpecs->delete($spec);
    }

    /**
     * Add image to product.
     *
     * @param $image
     * @param Product $product
     *
     * @return mixed
     */
    public function addImage($image, Product $product)
    {
        if ($image instanceof UploadedFile) {
            $location = 'upload/products/' . $product->id;
            $processor = new ImageProcessor();
            $imageable = $processor->uploadAndCreate($image, $product, null, $location);

            return $imageable;
        }
    }

    /**
     * Remove Image.
     *
     * @param Request $request
     * @param $lot
     */
    public function removeImage(Request $request, $lot)
    {
        Image::find($request->get('image_id'))->delete();
    }

    /**
     * Save image order.
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