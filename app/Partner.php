<?php
namespace App;

use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\PartnerPresenter;
use App\Traits\ActivateableTrait;
use App\Traits\HasImages;
use App\Traits\RankedableTrait;
use Keyhunter\Administrator\Repository;

class Partner extends Repository
{
    use ActivateableTrait, RankedableTrait, HasImages, Presenterable;

    /**
     * @var string
     */
    protected $table = 'partners';

    /**
     * @var PartnerPresenter
     */
    protected $presenter = PartnerPresenter::class;

    /**
     * @var array
     */
    protected $fillable = ['name', 'link', 'active', 'rank'];

    /**
     * @var bool
     */
    public $timestamps = false;
}