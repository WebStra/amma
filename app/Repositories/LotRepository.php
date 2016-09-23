<?php

namespace App\Repositories;

use App\Lot;
use App\Vendor;

class LotRepository extends Repository
{
    /**
     * @return Lot
     */
    public function getModel()
    {
        return new Lot();
    }

    /**
     * Create plain lot for attached items to him.
     *
     * @param Vendor $vendor
     * @return mixed
     */
    public function createDraft(Vendor $vendor)
    {
        return $this->getModel()
            ->firstOrCreate([
                'vendor_id' => $vendor->id
            ]);
    }
}