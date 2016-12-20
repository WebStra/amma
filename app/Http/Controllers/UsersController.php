<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvolveProductRequest;
use App\Http\Requests\ExitProductRequest;
use App\Repositories\InvolvedRepository;
use App\Repositories\LotRepository;
use App\Repositories\SpecPriceRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var InvolvedRepository
     */
    protected $involved;

    /**
     * @var LotRepository
     */
    protected $lot;

    /**
     * @var SpecPriceRepository
     */
    protected $specs;

    /**
     * UsersController constructor.
     * @param InvolvedRepository $involvedRepository
     */
    public function __construct(InvolvedRepository $involvedRepository,
                                LotRepository $lotRepository,
                                SpecPriceRepository $specPriceRepository)
    {
        $this->involved = $involvedRepository;
        $this->lot = $lotRepository;
        $this->specs = $specPriceRepository;
    }

    /**
     * Involve the product method.
     *
     * @param InvolveProductRequest $request
     * @param $product
     * @return \Illuminate\Http\RedirectResponse
     */

    public function involveProductOffer(InvolveProductRequest $request, $product)
    {
        $selledPrice = $this->countInvolvedLot($product);

        $this->involved->createOrUpdate(['count' => $request->get('count')], $product);

        if ($selledPrice >= $product->lot->yield_amount) {

            $product->lot->update(['verify_status' => 'expired']);

            return redirect()->back()->with(['status' => 'Oferta este finisata!', 'color' => 'green']);
        }

        return redirect()->back()->with(['status' => 'Success! You are involve the product offer.', 'color' => 'green']);
    }

    /**
     * Exit involved product.
     *
     * @param ExitProductRequest $request
     * @param $involve
     * @return \Illuminate\Http\RedirectResponse
     */
    public function exitProductOffer(ExitProductRequest $request, $involve, $product)
    {
        $involve = $this->involved->update($involve, ['active' => 0]);

        $remaining = config('product.times') - $this->involved->getInvolveTimesProduct($involve->product);

        $selledPrice = $this->countInvolvedLot($product);

        if ($selledPrice < $product->lot->yield_amount) {
            $product->lot->update(['verify_status' => 'verified']);
            return redirect()->back()->with(['status' => 'Oferta continua!', 'color' => 'green']);
        }


        return redirect()->back()->withStatus('Success! You are exit from product offer. Remaining attempts (' . $remaining . ')');
    }

    /**
     * @param $product
     * @return number
     */
    public function countInvolvedLot($product)
    {
        $count = $product->lot->involved;

        foreach ($count as $item) {
            $changes[] = $item->count * $this->specs->getPriceById($item->price_id);
        }
        return array_sum($changes);
    }
}