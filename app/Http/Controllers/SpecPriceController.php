<?php

namespace App\Http\Controllers;
use Illuminate\Session\Store;
use Illuminate\Http\Request;
use App\SpecPrice;
use App\ImprovedSpec;
use App\Repositories\SpecPriceRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\ImprovedSpecRepository;

class SpecPriceController extends Controller
{

    protected $session;
    protected $specPrice;
    protected $improvedSpecs;
    public function __construct(
        Store $session,
        SpecPriceRepository $specPriceRepository,
        ImprovedSpecRepository $improvedSpecRepository
    )
    {
        $this->session        = $session;
        $this->specPrice      = $specPriceRepository;
        $this->improvedSpecs  = $improvedSpecRepository;

    }


    public function remove(Request $request)
    {
        $spec = $this->specPrice->find($request->get('spec_id'));
        if ($spec) {
            $spec->removeMetaGroupById('spec_price', $request->get('spec_id'));
            $this->specPrice->delete($request->get('spec_id'));
        }
        return response(array('type' => true));
    }

    public function removeSpec(Request $request)
    {
        $spec = $this->specPrice->find($request->get('spec_id'));
        if ($spec) {
            $spec->removeMetaById($request->get('spec_id'));
        }
    }

    public function removeGroupSizeColor(Request $request)
    {
        $spec = $this->specPrice->find($request->get('spec_id'));
        if ($spec) {
            $spec->removeMetaById($request->get('spec_id'));
        }
    }
    
    public function removeSpecPriceColor(Request $request)
    {
        $spec = $this->specPrice->find($request->get('spec_id'));
        if ($spec) {
            $spec->removeMetaById($request->get('spec_id'));
        }
    }

    public function loadImprovedSpecPrice(Request $request)
    {
        $block_id = ($request->get('block_id')) ? $request->get('block_id') : 1;
        return view('lots.partials.form.size_specs', ['block_id' => $block_id]);
    }
    public function loadSpecPriceDescription(Request $request)
    {
        $block_id = ($request->get('block_id')) ? $request->get('block_id') : 1;
        return view('lots.partials.form.description_specs', ['block_id' => $block_id]);
    }
    public function loadSpecPriceColor(Request $request)
    {
        $block_id = ($request->get('block_id')) ? $request->get('block_id') : 1;
        return view('lots.partials.form.color_specs', ['block_id' => $block_id]);
    }
    public function removeImproveSpecPrice(Request $request)
    {
        $spec = $this->improvedSpecs->find($request->get('spec_id'));
        if ($spec) {
            $this->improvedSpecs->delete($spec);
        }
        
    }


}