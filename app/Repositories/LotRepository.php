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

    /**
     * Add empty lot or modify just existed (drafted)..
     *
     * @param $vendor
     * @return Lot|mixed
     */
    public function addLot($vendor)
    {
        if($lot = $this->getDraftedLot($vendor))
            return $lot;

        return $this->createDraft($vendor);
    }

    /**
     * Get drafted lot
     *
     * @param $vendor
     * @return Lot $Lot|null
     */
    public function getDraftedLot($vendor)
    {
        $lot = $this->getModel()
            ->where('vendor_id', $vendor->id)
            ->drafted()
            ->first();

        return ($lot) ? $lot : null;
    }

    /**
     * Get user's lots.
     *
     * @param $user
     * @param $perPage
     * @return \Illuminate\Support\Collection|null
     */
    public function userLots($user, $perPage = 5)
    {
        $model = self::getModel();

        $vendors = [];

        $user->vendors()->active()->get()
            ->each(function($vendor) use (&$vendors){
                $vendors[] = $vendor->id;
            });

        $lots = $this->getModel()
            ->whereIn('vendor_id', $vendors)
            ->where('status', '!=', $model::STATUS_DELETED)
            ->paginate($perPage);

        return ($lots->count()) ? $lots : null;
    }

    /**
     * Delete lot.
     *
     * @param $lot
     */
    public function delete($lot)
    {
        $model = self::getModel();
        if($lot->status !== $model::STATUS_DELETED)
        {
            $lot->status = $model::STATUS_DELETED;

            $lot->save();
        }
    }
}