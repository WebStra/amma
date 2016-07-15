<?php

namespace App\Http\ViewComposers;

use App\Repositories\FaqRepository;
use Illuminate\Contracts\View\View;

class FaqComposer extends Composer
{
    /**
     * @var FaqRepository
     */
    protected $faqRepository;

    /**
     * FaqComposer constructor.
     * @param FaqRepository $faqRepository
     */
    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * @param View $view
     *
     * @return $view
     */
    public function compose(View $view)
    {
        return $view->with('faq', $this->faqRepository->getPublic());
    }
}