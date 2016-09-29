<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLotRequest;
use App\Lot;
use App\Repositories\LotRepository;
use App\Repositories\ProductsRepository;
use App\Vendor;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

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
     * LotsController constructor.
     * @param LotRepository $lotRepository
     * @param ProductsRepository $productsRepository
     * @param Guard $auth
     */
    public function __construct(LotRepository $lotRepository, ProductsRepository $productsRepository, Guard $auth)
    {
        $this->lots = $lotRepository;
        $this->auth = $auth;
        $this->products = $productsRepository;
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

        return view('lots.create', compact('lot'));
    }

    /**
     * @param Lot $lot
     * @return \Illuminate\View\View
     */
    public function edit(Lot $lot)
    {
        return view('lots.create', compact('lot'));
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
     * Load product form for lot create/edit.
     *
     * @param Request $request
     * @param Lot $lot
     * @return mixed
     */
    public function loadProductBlock(Request $request, Lot $lot)
    {
        $product = $this->products->createPlain($lot);

        return view('lots.partials.form.product', [ 'product' => $product, 'lot' => $lot ]);
    }

    /**
     * @param SaveLotRequest $request
     * @param Lot $lot
     * @return mixed
     */
    public function saveLot(SaveLotRequest $request, Lot $lot)
    {
        $lot = $this->lots->save($lot, $request->all());

        return redirect()->back()->withStatus('You created lot successefully. Waiting for moderator verify it. You will be notificated!');

//        return redirect()->route('view_lot', [ 'lot' => $lot->id ]);
    }

    public function index()
    {
        dd(Lot::all());
//        return
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