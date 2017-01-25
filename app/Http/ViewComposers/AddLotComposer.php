<?php

namespace App\Http\ViewComposers;

use App\Repositories\CategoryRepository;
use App\Repositories\CurrenciesRepository;
use App\Repositories\UnitRepository;
use App\Repositories\LotRepository;
use Illuminate\Contracts\View\View;

class AddLotComposer extends Composer
{
    /**
     * @var LotRepository
     */
    protected $lots;

    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * @var CurrenciesRepository
     */
    protected $currencies;
    /**
     * @var UnitRepository
     */
    protected $units;
    /**
     * AddLotComposer constructor.
     * @param LotRepository $lotRepository
     * @param CategoryRepository $categoryRepository
     * @param CurrenciesRepository $currenciesRepository
     */
    public function __construct(
        LotRepository $lotRepository,
        CategoryRepository $categoryRepository,
        CurrenciesRepository $currenciesRepository,
        UnitRepository $unitsRepository
    ) {
        $this->lots       = $lotRepository;
        $this->categories = $categoryRepository;
        $this->currencies = $currenciesRepository;
        $this->units      = $unitsRepository;
    }

    /**
     * Bind view to data.
     * 
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        $categories = $this->categories->getPublic();
        $currencies = $this->currencies->getPublic();
        $units      = $this->units->getPublic();

        return $view
            ->with('categories', $categories)
            ->with('currencies', $currencies)
            ->with('units', $units);
    }
}