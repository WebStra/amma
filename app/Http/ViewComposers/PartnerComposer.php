<?php

namespace App\Http\ViewComposers;

use App\Repositories\PartnerRepository;
use Illuminate\Contracts\View\View;

class PartnerComposer extends Composer
{
    /**
     * @var PartnerRepository
     */
    protected $partners;

    /**
     * PartnerComposer constructor.
     * @param PartnerRepository $partnerRepository
     */
    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->partners = $partnerRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        return $view->with('partners', $this->partners->getFooterList());
    }
}