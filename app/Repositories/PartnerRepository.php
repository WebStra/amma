<?php

namespace App\Repositories;

use App\Partner;

class PartnerRepository extends Repository
{
    /**
     * @return Partner
     */
    public function getModel()
    {
        return new Partner();
    }

    /**
     * Get all active partners for footer.
     *
     * @return mixed
     */
    public function getFooterList()
    {
        return self::getModel()
            ->where('show_in_footer', 1)
            ->active()
            ->orderBy('rank', self::ASC)
            ->get();
    }
}