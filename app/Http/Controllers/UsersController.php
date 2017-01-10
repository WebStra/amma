<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvolveProductRequest;
use App\Http\Requests\ExitProductRequest;
use App\Repositories\InvolvedRepository;
use App\Repositories\LotRepository;
use App\Repositories\ModelColorsRepository;
use App\Repositories\SpecPriceRepository;
use File;
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
     * @var ModelColorsRepository
     */
    protected $color;

    /**
     * UsersController constructor.
     * @param InvolvedRepository $involvedRepository
     */
    public function __construct(InvolvedRepository $involvedRepository,
                                LotRepository $lotRepository,
                                SpecPriceRepository $specPriceRepository,
                                ModelColorsRepository $modelColorsRepository
    )
    {
        $this->color = $modelColorsRepository;
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

        $color = $this->color->findRowById($request->color_product);

        if (isset($color->amount) && $color->amount <= 0) {
            return redirect()->back()->with(['status' => 'Stock epuizat!', 'color' => 'red']);
        } else {
            if (isset($request->color_product)) {
                if ($request->count > $color->amount) {
                    return redirect()->back()->with(['status'=>'Ati intrecut limita de produse','color'=>'red']);
                }
                $refactorAmount = $color->amount - $request->count;
                $color->update(['amount' => $refactorAmount]);
            }
        }

        $this->involved->create($request->all(), $product);

        $selledPrice = $this->countInvolvedLot($product);

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
        $this->amountRefactoringExitProduct($involve);

        $involve = $this->involved->update($involve, ['active' => 0]);

        $remaining = config('product.times') - $this->involved->getInvolveTimesProduct($involve->product);

        if ($this->countInvolvedLot($product) < $product->lot->yield_amount) {
            $product->lot->update(['verify_status' => 'verified']);
        }
        return redirect()->back()->with(['status' => 'Success! You are exit from product offer. Remaining attempts (' . $remaining . ')', 'color' => 'green']);
    }

    /**
     * @param $product
     * @return number
     */

    public function amountRefactoringExitProduct($involve)
    {
            $color = $this->color->findRowById($involve->color_id);

            if($color != Null){
                $refactorAmount = $color->amount + $involve->count;
                $color->update(['amount' => $refactorAmount]);
            }
    }


    public function countInvolvedLot($product)
    {
        $count = $product->lot->involved;
        $currency = $this->currency($product->lot->currency->title);

        if (count($count) > 0) {
            if ($currency['title'] == 'USD' || $currency['title'] == 'EUR') {
                foreach ($count as $item) {
                    $changes[] = ($item->count * $this->specs->getPriceById($item->price_id)) * $currency['currency'];
                }
                return array_sum($changes);
            } else {
                foreach ($count as $item) {
                    $changes[] = ($item->count * $this->specs->getPriceById($item->price_id));
                }
                return array_sum($changes);
            }
        }
    }

    public function currency($title)
    {
        $currency = json_decode(File::get(storage_path('app/json_currency.json')));

        if ($title == 'USD')
            return ['currency' => $currency->USD, 'title' => $title];

        if ($title == 'EUR')
            return ['currency' => $currency->EUR, 'title' => $title];
    }


}