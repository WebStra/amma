<?php

namespace App\Http\ViewComposers;

use App\Repositories\CategoryRepository;
use App\Repositories\CurrenciesRepository;
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
     * AddLotComposer constructor.
     * @param LotRepository $lotRepository
     * @param CategoryRepository $categoryRepository
     * @param CurrenciesRepository $currenciesRepository
     */
    public function __construct(
        LotRepository $lotRepository,
        CategoryRepository $categoryRepository,
        CurrenciesRepository $currenciesRepository
    ) {
        $this->lots = $lotRepository;
        $this->categories = $categoryRepository;
        $this->currencies = $currenciesRepository;
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

        return $view
            ->with('categories', $categories)
            ->with('currencies', $currencies);
    }
}