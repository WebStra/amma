<?php

namespace App\Http\ViewComposers;

use App\Repositories\SocialRepository;
use Illuminate\Contracts\View\View;

class SocialComposer extends Composer
{
    /**
     * @var SocialRepository
     */
    protected $socials;

    /**
     * SocialComposer constructor.
     * @param SocialRepository $socialRepository
     */
    public function __construct(SocialRepository $socialRepository)
    {
        $this->socials = $socialRepository;
    }

    /**
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        return $view->with('socials', $this->socials->getFooterList());
    }
}