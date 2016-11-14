<?php

namespace App\Http\Middleware;

use App\Lot;
use App\Repositories\LotRepository;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class AddLotMiddleware
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @var LotRepository
     */
    protected $lots;

    /**
     * AddLotMiddleware constructor.
     * @param Guard $auth
     * @param LotRepository $lotRepository
     */
    public function __construct(Guard $auth, LotRepository $lotRepository)
    {
        $this->auth = $auth;
        $this->lots = $lotRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($lot = $request->route('lot'))
        {
            if($lot->status == Lot::STATUS_DRAFTED)
            {
                $category = $lot->category;

                if($this->eraseFromWallet($lot, $category->tax))
                {
                    $lot->status = Lot::STATUS_COMPLETE;

                    $lot->save();

                    return $next($request);
                } else {
                    return redirect()->back()->withSuccess('У вас недостаточно средств');
                }
            }
        }

        return redirect()->back()->withSuccess('Something Wrong!');
    }

    /**
     * @param $lot
     * @param $tax
     * @return bool
     */
    private function eraseFromWallet($lot, $tax)
    {
        $user = $this->auth->user();
        $amount = $lot->yield_amount;

        if(! $user->isAdmin())
        {
            return $this->eraseSummFromWallet($tax, $amount);
        } else {
            $lot->status = Lot::STATUS_COMPLETE;
            $lot->save();

            return true;
        }
    }

    /**
     * @param $tax
     * @param $amount
     * @return bool
     */
    public function eraseSummFromWallet($tax, $amount)
    {
        $wallet = $this->auth->user()->wallet;

        $summ = $this->calcEraseSumm($tax, $amount);

        $calc = $wallet->amount - $summ;

        if($calc > 0)
        {
            return $wallet->fill([
                'amount' => $calc
            ])->save();
        }

        return false;
    }

    /**
     * @param $tax
     * @param $amount
     * @return float|int
     */
    public function calcEraseSumm($tax, $amount)
    {
        return ($amount / (100 * $tax));
    }
}