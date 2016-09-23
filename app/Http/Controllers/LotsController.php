<?php

namespace App\Http\Controllers;

use App\Repositories\LotRepository;
use Illuminate\Http\Request;

class LotsController extends Controller
{
    /**
     * @var LotRepository
     */
    protected $lots;

    /**
     * LotsController constructor.
     * @param LotRepository $lotRepository
     */
    public function __construct(LotRepository $lotRepository)
    {
        $this->lots = $lotRepository;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('lots.create');
    }

    public function postCreate(Request $request)
    {
        
    }
    
    public function index()
    {
        
    }
}