<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvolveProductRequest;
use App\Http\Requests\ExitProductRequest;
use App\Repositories\InvolvedRepository;
use App\Repositories\LotRepository;
use App\Repositories\ModelColorsRepository;
use App\Repositories\SpecPriceRepository;
use App\Repositories\UserRepository;
use File;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */
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
     * @var UserRepository
     */
    protected $user;

    /**
     * UsersController constructor.
     * @param InvolvedRepository $involvedRepository
     */
    public function __construct(InvolvedRepository $involvedRepository,
                                LotRepository $lotRepository,
                                SpecPriceRepository $specPriceRepository,
                                ModelColorsRepository $modelColorsRepository,
                                UserRepository $userRepository
    )
    {
        $this->color = $modelColorsRepository;
        $this->involved = $involvedRepository;
        $this->lot = $lotRepository;
        $this->user = $userRepository;
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
                    return redirect()->back()->with(['status' => 'Ati intrecut limita de produse', 'color' => 'red']);
                }
                $refactorAmount = $color->amount - $request->count;
                $color->update(['amount' => $refactorAmount]);
            }
        }

        $this->involved->create($request->all(), $product);

        $selledPrice = $this->countInvolvedLot($product);

        if ($selledPrice >= $product->lot->yield_amount) {
            $product->lot->update(['verify_status' => 'expired']);
            $this->sendVendorMessage($product->lot);
            $this->sendUsersMessage($product->lot);
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
     * @param $lot
     * @return array
     */
    public function userinvolvedList($lot)
    {
        $array = [];

        foreach ($lot->involved as $item) {

            $array[] = [
                'user' => [
                    'id' => $item->user->id,
                    'firstname' => $item->user->profile->firstname,
                    'lastname' => $item->user->profile->lastname,
                    'email' => $item->user->email,
                    'phone' => $item->user->profile->phone,
                    'count' => $item->count,
                    'product_hash' => $item->product_hash,
                ],
            ];
        }
        return $array;
    }

    /**
     * @param $lot
     * @return array
     */
    public function getUserProducstInvolved($lot)
    {
        $array = [];

        foreach ($lot->involved->unique('user_id') as $item) {
            $array[] = [
                'user' => [
                    'id'        => $item->user->id,
                    'firstname' => $item->user->profile->firstname,
                    'lastname'  => $item->user->profile->lastname,
                    'email'     => $item->user->email,
                    'phone'     => $item->user->profile->phone,
                    'count'     => $item->count,
                    'products'  => $this->getProductsInvolved($item->lot_id, $item->user_id)
                ],
            ];
        }
        return $array;
    }

    public function getProductsInvolved($lot_id, $user_id)
    {
        $products = [];
        $getUserInvolved = $this->involved->getUserInvolved($lot_id, $user_id);
        foreach ($getUserInvolved as $item) {
            $products[] = [
                'name'         => $item->price->name,
                'price'        => $item->price->new_price,
                'count'        => $item->count,
                'color'        => $item->involvedColor->color_hash,
                'size'         => $item->improvedSpec->size,
                'product_hash' => $item->product_hash,
            ];
        }
        return $products;
    }
    /**
     * @param $lot
     */
    public function sendVendorMessage($lot)
    {
        $users = $this->userinvolvedList($lot);

        \Mail::send('emails.lot-expired-vendor', compact('users','lot'), function (Message $message) use ($users, $lot) {
            $message->to($lot->vendor->email)
                ->subject("Lotul a expirat");
        });
    }

    /**
     * @param $lot
     */

    public function sendUsersMessage($lot)
    {
        $users = $this->userinvolvedList($lot);
        /*$users = $this->getUserProducstInvolved($lot);
        $send_email = array_pluck($users, 'email');*/
        $emails = [];

        foreach ($users as $item) {
            $emails[] = $item['user']['email'];
        }

        $vendor = $lot->vendor;

        \Mail::send('emails.lot-expired-users', compact('emails','vendor','lot'), function (Message $message) use ($emails,$vendor,$lot) {
            $message->to(array_unique($emails))->subject('Oferta este finisata!');
        });
    }

    /**
     * @param $product
     * @return number
     */

    public function amountRefactoringExitProduct($involve)
    {
        $color = $this->color->findRowById($involve->color_id);

        if ($color != NULL) {
            $refactorAmount = $color->amount + $involve->count;
            $color->update(['amount' => $refactorAmount]);
        }
    }

    /**
     * @param $product
     * @return number
     */
    public function countInvolvedLot($product)
    {
        $count = $product->lot->involved;

        if (count($count) > 0) {
            foreach ($count as $item) {
                $changes[] = ($item->count * $this->specs->getPriceById($item->price_id));
            }
            return array_sum($changes);
        }
    }
}