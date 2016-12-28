<?php

namespace App\Http\Controllers;
use Illuminate\Session\Store;
use Illuminate\Http\Request;
use App\SpecPrice;
use App\ImprovedSpec;
use App\Repositories\LotRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\SpecPriceRepository;
use App\Repositories\ImprovedSpecRepository;
use App\Repositories\CurrenciesRepository;

class SpecPriceController extends Controller
{

    protected $session;
    protected $lots;
    protected $products;
    protected $specPrice;
    protected $improvedSpecs;
    protected $currencies;
    public function __construct(
        Store $session,
        LotRepository $lotRepository,
        ProductsRepository $productsRepository,
        SpecPriceRepository $specPriceRepository,
        ImprovedSpecRepository $improvedSpecRepository,
        CurrenciesRepository $currenciesRepository
    )
    {
        $this->session       = $session;
        $this->lots          = $lotRepository;
        $this->products      = $productsRepository;
        $this->specPrice     = $specPriceRepository;
        $this->improvedSpecs = $improvedSpecRepository;
        $this->currencies    = $currenciesRepository;

    }

    public function removeImproveSpecPrice(Request $request)
    {
        $spec = $this->improvedSpecs->find($request->get('spec_id'));
        if ($spec) {
            $this->improvedSpecs->delete($spec);
        }
        
    }


}