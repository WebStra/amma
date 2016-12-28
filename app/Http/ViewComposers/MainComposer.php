<?php

namespace App\Http\ViewComposers;
use App\Repositories\LotRepository;
use Illuminate\Contracts\View\View;

class MainComposer extends Composer
{
    /**
     * @var LotRepository
     */
    protected $lots;


    /**
     * AddLotComposer constructor.
     * @param LotRepository $lotRepository
     */
    public function __construct(
        LotRepository $lotRepository
    ) {
        $this->lots = $lotRepository;
    }

    /**
     * Bind view to data.
     * 
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        $comision   = \Auth::check() ? $this->lots->userLotsPendingComision(\Auth::user()) : 0;
        return $view
            ->with('comision', $comision);
    }
}