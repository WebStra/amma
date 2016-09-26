<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLotRequest;
use App\Lot;
use App\Repositories\LotRepository;
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
     * LotsController constructor.
     * @param LotRepository $lotRepository
     * @param Guard $auth
     */
    public function __construct(LotRepository $lotRepository, Guard $auth)
    {
        $this->lots = $lotRepository;
        $this->auth = $auth;
    }
    
    public function create(Vendor $vendor)
    {
        $lot = $this->lots->addLot($vendor);
        
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

    public function saveLot(SaveLotRequest $request, Lot $lot)
    {
        $lot = $this->lots->save($lot, $request->all());
        
        return redirect()->route('view_lot', [ 'lot' => $lot->id ]);
    }

    /**
     * Show user's all lots;
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $lots = $this->lots->userLots($this->getUser(), 5);

        return view('lots.my_lots', compact('lots'));
    }

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