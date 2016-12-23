<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLotRequest;
use App\Lot;
use App\Repositories\ImprovedSpecRepository;
use App\Repositories\SpecPriceRepository;
use App\Repositories\LotRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\SubCategoriesRepository;
use App\Repositories\MethodDeliveryPaymentRepository;
use App\Repositories\LotDeliveryPaymentRepository;
use App\Repositories\CurrenciesRepository;
use App\Vendor;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;

class LotsController extends Controller
{
    /**
     * @var LotRepository
     */
    protected $lots;

    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * @var ImprovedSpecRepository
     */
    protected $improvedSpecs;

    protected $specPrice;


    protected $sub_category;

    protected $method;

    protected $lot_method;

    protected $currencies;

    /**
     * LotsController constructor.
     * @param LotRepository $lotRepository
     * @param ProductsRepository $productsRepository
     * @param ImprovedSpecRepository $improvedSpecRepository
     * @param Guard $auth
     */
    public function __construct(
        LotRepository $lotRepository,
        ProductsRepository $productsRepository,
        ImprovedSpecRepository $improvedSpecRepository,
        SpecPriceRepository $specPriceRepository,
        SubCategoriesRepository $subCategoriesRepository,
        MethodDeliveryPaymentRepository $methodDeliveryPaymentRepository,
        LotDeliveryPaymentRepository $lotDeliveryPaymentRepository,
        CurrenciesRepository $currenciesRepository,
        Guard $auth
    ) {
        $this->lots          = $lotRepository;
        $this->auth          = $auth;
        $this->products      = $productsRepository;
        $this->improvedSpecs = $improvedSpecRepository;
        $this->specPrice     = $specPriceRepository;
        $this->sub_category  = $subCategoriesRepository;
        $this->method        = $methodDeliveryPaymentRepository;
        $this->lot_method    = $lotDeliveryPaymentRepository;
        $this->currencies    = $currenciesRepository;
    }

    /**
     * Create lot or modify drafted for vendor.
     *
     * @param Vendor $vendor
     * @return \Illuminate\View\View
     */
    public function create(Vendor $vendor)
    {
        $lot = $this->lots->addLot($vendor);
        $delivery = $this->method->getPublic('delivery');
        $payment = $this->method->getPublic('payment');
        return view('lots.create', compact('lot','delivery','payment'));
    }

    /**
     * @param Lot $lot
     * @return \Illuminate\View\View
     */
    public function edit(Lot $lot)
    {
        //dd($lot->lotDeliveryPayment());
        $delivery = $this->method->getPublic('delivery');
        $payment = $this->method->getPublic('payment');
        return view('lots.create', compact('lot','delivery','payment'));
    }

    /**
     * Remove lot.
     *
     * @param Lot $lot
     * @return mixed
     */
    public function delete(Lot $lot)
    {
        $this->lots->delete($lot);

        return redirect()->route('my_lots')
            ->withStatus(sprintf('Lot %s was removed', $lot->present()->renderName()));
    }

    /**
     * Select category.
     *
     * @param Request $request
     * @param Lot $lot
     *
     * @return string
     */
/*    public function selectCategory(Request $request, Lot $lot)
    {
        if($this->lots->checkIfPossibleToChangeCategory($lot)) {
            $this->lots->changeCategory($lot, $request->get('category_id'));
            return 'true';
        }

        return 'false';
    }*/

    public function selectCategory(Request $request, Lot $lot)
    {
        $sub_category = $this->sub_category->getSubCategory($request->get('category_id'));
        $this->lots->changeCategory($lot, $request->get('category_id'));
        $json = array(
            'sub_category' => $sub_category,
            'respons'      => true
        );
         return response($json);
    }

    /**
     * Load product form for lot create/edit.
     *
     * @param Request $request
     * @param Lot $lot
     * @return mixed
     */
    public function loadProductBlock(Request $request, Lot $lot)
    {
        if($lot->category_id) {
            $product = $this->products->createPlain($lot);

            return view('lots.partials.form.product', ['product' => $product, 'lot' => $lot]);
        }

        return 'false';
    }

    /**
     * Load specification
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    /**
     * Load improved spec.
     * 
     * @param Request $request
     * @return mixed
     */
    public function loadImprovedSpec(Request $request)
    {
        $spec = $this->improvedSpecs->createPlain($request->get('product_id'));
        
        return view('lots.partials.form.improved_specs', [ 'spec' => $spec ]);
    }

    /**
     * @param SaveLotRequest $request
     * @param Lot $lot
     * @return mixed
     */
    public function saveLot(SaveLotRequest $request, Lot $lot)
    {
        $lot = $this->lots->save($lot, $request->all());
        return redirect()->route('edit_lot', [ $lot ])
            ->withStatus('You created lot successefully. Waiting for moderator verify it. You will be notificated!');
    }

    public function updateLot(SaveLotRequest $request, Lot $lot)
    {
        $lot = $this->lots->save($lot, $request->all());
        $method = [];
        if ($request->input('method')) {
            $method  = $request->input('method');
        }
        $lot = $this->lot_method->save($lot, $method);
        return response(array('respons'=>true));
        
    }


    /**
     *
     */
    public function index()
    {
       /* dd(Lot::all());*/
    }

    /**
     * Show user's all lots;
     *
     * @return \Illuminate\View\View
     */
    public function myLots()
    {
        $lots = $this->lots->userLots($this->getUser(), 5);

        return view('lots.my_lots', compact('lots'));
    }

    /**
     * @param Lot $lot
     * @return mixed
     */
    public function show(Lot $lot)
    {
        return view('lots.show', compact('lot'));
    }


    /**
     * Get user from Guard\Auth
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUser()
    {
        return $this->auth->user();
    }
}