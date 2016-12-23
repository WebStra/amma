<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\SaveProductRequest;
use App\Image;
use App\ImprovedSpec;
use App\Lot;
use App\Repositories\ImprovedSpecRepository;
use App\Repositories\SpecPriceRepository;
use App\Repositories\LotRepository;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Repositories\CategoryableRepository;
use App\Repositories\InvolvedRepository;
use App\Repositories\ModelColorsRepository;
use App\Services\ImageProcessor;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Session\Store;
use App\Repositories\ProductsRepository;
use XmlParser;
use Storage;

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
     * @var modelColorsRepository
     */
    protected $modelColors;

    /**
     * @var LotRepository
     */
    protected $lots;

    /**
     * @var ImprovedSpec
     */
    protected $improvedSpecs;
    protected $specPrice;

    /**
     * ProductsController constructor.
     * @param Store $session
     * @param ProductsRepository $productsRepository
     * @param CategoryableRepository $categoryableRepository
     * @param ModelColorsRepository $modelColorsRepository
     * @param InvolvedRepository $involvedRepository
     * @param LotRepository $lotRepository
     * @param ImprovedSpecRepository $improvedSpecRepository
     */
    public function __construct(
        Store $session,
        ProductsRepository $productsRepository,
        CategoryableRepository $categoryableRepository,
        ModelColorsRepository $modelColorsRepository,
        InvolvedRepository $involvedRepository,
        LotRepository $lotRepository,
        ImprovedSpecRepository $improvedSpecRepository,
        SpecPriceRepository $specPriceRepository
    )
    {
        $this->session       = $session;
        $this->products      = $productsRepository;
        $this->categoryable  = $categoryableRepository;
        $this->modelColors   = $modelColorsRepository;
        $this->involved      = $involvedRepository;
        $this->lots          = $lotRepository;
        $this->improvedSpecs = $improvedSpecRepository;
        $this->specPrice     = $specPriceRepository;

    }

    /**
     * @param SaveProductRequest $request
     * @param Product $product
     * @return mixed
     */
    public function save(SaveProductRequest $request, Lot $lot, Product $product)
    {
        $product = $this->products->saveProduct($product, $request->all());

        if (!empty($spec_price = $request->get('spec_price')))
            $this->saveSpecificationsAll($request,$product);

       /* if (!empty($spec = $request->get('spec')))
            $this->saveSpecifications($spec, $product);

        if (!empty($fileInput = $request->file('image')))
            array_walk($fileInput, function($image) use (&$product){
                $this->addImage($image, $product);
            });

        if (!empty($specs = $request->get('i_spec')))
            $this->saveImprovedSpecifications($specs, $product);
*/
        $json = array(
            'respons' => true
        );
         return response($json);
        //return view('lots.partials.form.product', [ 'lot' => $lot, 'product' => $product]);
    }

    /**
     * Show inner product.
     *
     * @param $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($product)
    {
        $itemPercentage = $this->getSalledPercent($product->id);

        $lot = $this->lots->find($product->lot_id);

        $productInLot=$this->products->countInLotProduct($product->lot_id);

        $same_products = $this->products->getSameProduct($product->sub_category_id);

        $view = view('product.show',['item'=>$product,'lot'=>$lot,'similar'=>$same_products ,'productItem'=> $itemPercentage,'productinlot'=>$productInLot]);

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

/*    public function convertAmount(){
        $xml = XmlParser::load('http://www.bnm.org/ro/official_exchange_rates?get_xml=1&date='.date("d.m.Y"));

        $parsed = $xml->parse([
            'cursToDay' => ['uses' => 'Valute[CharCode,Value]'],
        ]);

        $currency = array('EUR','USD');
        $json = array();
        foreach ($parsed as $key => $item) {
            foreach ($item as $key => $val) {
                if (in_array($val['CharCode'], $currency)) {
                    $json[$val['CharCode']] = $val['Value'];
                }
            }
        }
        $put = Storage::put('json_currency.json', json_encode($json));
    }*/

    public function getSalledPercent($id)
    {
        $count = $this->products->getCount($id);
        $selled = $this->involved->getCountSelled($id);
        ($count) ? $result = number_format((100 * $selled)  / $count) : $result = 0;

        return array(['totalItems'=>$count,'salePercent'=>$result]);
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

        $product = $this->products->find($request->get('product_id'));
        if ($product) {
            $product->removeMetaGroupById('spec', $request->get('product_id'));
        }
        $this->products->delete($request->get('product_id'));

        /*if($this->lots->checkIfPossibleToChangeCategory($lot))
            return 'enable_cat';*/
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


    private function saveSpecificationsAll($request, Product $product)
    {
        //dd($request->get('spec_price'));
        //dd(collect($request->get('spec_price'))->first());
        //$collection = $request->get('spec_price');
       /* $collection = collect($request->get('spec_price'));
        $filtered = $collection->filter(function ($item) {
            return $item['new_price'] != '' && $item['old_price'] != '';
        })->values();
        dd($filtered->all());*/
        if (!empty($spec = $request->get('spec_price'))) {
            array_walk($spec, function($data) use ($product,$request) {
                if (($data['new_price'] >= 0 && $data['old_price'] >= 0) && ($data['new_price'] != null && $data['old_price'] != null)) {
                    $specPriceInsert = $this->specPrice->save($data, $product);
                    if (!empty($specSize = $request->get('spec_size'))) {
                        array_walk($specSize, function($data) use ($specPriceInsert,$request) {
                            if ($data['size'] >= 0  && $data['size'] != null) {
                                $specSizeInsert = $this->improvedSpecs->create($data, $specPriceInsert);
                                if (!empty($specColor = $request->get('spec_color'))) {
                                    array_walk($specColor, function($data) use ($specSizeInsert,$request) {
                                        if ($data['color_hash'] != null  or ($data['amount'] >= 0 && $data['amount'] != null)) {
                                            $specColorInsert = $this->modelColors->create($data, $specSizeInsert);
                                        }
                                    });
                                }
                            }
                        });
                    }
                }
            });
        }
    }

    private function saveImprovedSpecifications($specs, $product)
    {
        array_walk($specs, function($data, $product){
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
        if ($product) {
            $product->removeMetaById($request->get('spec_id'));
        }
        
    }

    public function removeSpecPrice(Request $request)
    {
        $spec = $this->specPrice->find($request->get('spec_id'));
        $this->specPrice->delete($spec);
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