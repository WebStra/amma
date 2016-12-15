<?php
namespace App\Http\Controllers;

use App\SpecPrice;
use App\ImprovedSpec;
use App\Repositories\SpecPriceRepository;
use App\Repositories\ImprovedSpecRepository;
use Illuminate\Http\Request;
class SpecPriceController extends Controller
{

    protected $specPrice;
    protected $improvedSpecs;

    public function __construct(
        SpecPriceRepository $specPriceRepository,
        ImprovedSpecRepository $improvedSpecRepository
    )
    {
        $this->specPrice      = $specPriceRepository;
        $this->improvedSpecs  = $improvedSpecRepository;

    }


    public function remove(Request $request)
    {
        return response(array('type' => true));
       /* $this->specPrice->delete($request->get('spec_id'));
        $spec = $this->specPrice->find($request->get('spec_id'));
        $spec->removeMetaGroupById('spec_price', $request->get('spec_id'));
        return response(array('type' => true));*/
    }



}