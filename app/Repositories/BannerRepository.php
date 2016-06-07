<?php

namespace App\Repositories;

use App\Banner;

class BannerRepository extends Repository
{
    /**
     * @return Banner
     */
    public function getModel()
    {
        return new Banner();
    }

    /**
     * Get ad-blocks for extended banners block.
     *
     * @param $count
     * @return mixed
     */
    public function getExtendedAddBlocks($count = null)
    {
        return self::getModel()
            ->take(isset($count) ? $count : 2)
            ->active()
            ->orderBy('created_at', self::DESC)
            ->get();
    }

    public function getSmallAddBlocks($count = null)
    {
        return self::getModel()
            ->take(isset($count) ? $count : 2)
            ->active()
            ->orderBy('created_at', self::DESC)
            ->get();
    }

    public function getRightSideBarAddBlocks($count = null)
    {
        return self::getModel()
            ->take(isset($count) ? $count : 1)
            ->active()
            ->orderBy('created_at', self::ASC)
            ->get();
    }
}