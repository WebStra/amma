<?php

namespace App;

use App\Traits\ActivateableTrait;
use Keyhunter\Administrator\Repository;

class Banner extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'banners';

    /**
     * @var array
     */
    protected $fillable = ['link', 'image_url', 'rank', 'active'];
}