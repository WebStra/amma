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
    public function getBigAdBlocks($count = null)
    {
        return self::getModel()
            ->take(isset($count) ? $count : 2)
            ->active()
            ->orderBy('created_at', self::DESC)
            ->get();
    }

    /**
     * Get small adblocks for homepage.
     *
     * @param null $count
     * @return mixed
     */
    public function getSmallAdBlocks($count = null)
    {
        return self::getModel()
            ->take(isset($count) ? $count : 2)
            ->active()
            ->orderBy('created_at', self::DESC)
            ->get();
    }

    /**
     * Get adblocks for right sidebar of homepage.
     *
     * @param null $count
     * @return mixed
     */
    public function getRightSideBarAdBlocks($count = null)
    {
        return self::getModel()
            ->take(isset($count) ? $count : 1)
            ->active()
            ->orderBy('created_at', self::ASC)
            ->get();
    }
}