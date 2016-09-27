<?php

namespace App\Repositories;

use App\Lot;
use App\Vendor;
use Carbon\Carbon;

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
     * @param $vendor|null
     * @return Lot $Lot|null
     */
    public function getDraftedLot($vendor = null)
    {
        $query = $this->getModel();

        if($vendor)
            $query->where('vendor_id', $vendor->id);

        $lot = $query->drafted()->first();

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

    /**
     * Convert string date to \Carbon/Carbon timestamp.
     *
     * @param $date
     * @return static
     */
    public function dateToTimestamp($date)
    {
        $dates = $this->reformatDateString($date);

        return Carbon::createFromDate($dates['y'], $dates['m'], $dates['d']);
    }

    /**
     * Reformat date.
     *
     * @param $date
     * @param string $delimiter
     * @return mixed
     */
    public function reformatDateString($date, $delimiter = '.')
    {
        $datas = explode($delimiter, $date);

        $new_date['d'] = $datas[0];
        $new_date['m'] = $datas[1];
        $new_date['y'] = $datas[2];

        return $new_date;
    }

    public function save($lot, array $data)
    {
        $model = self::getModel();

        $lot->fill([
            'name' => isset($data['name']) ? $data['name'] : $lot->present()->renderDraftedName(),
            'category_id' => isset($data['category']) ? $data['category'] : null,
            'currency_id' => isset($data['currency']) ? $data['currency'] : null,
            'status' => $model::STATUS_COMPLETE,
            'description' => isset($data['description']) ? $data['description'] : null,
            'yield_amount' => isset($data['yield_amount']) ? $data['yield_amount'] : null,
            'public_date' => isset($data['public_date']) ? $this->dateToTimestamp($data['public_date']) : Carbon::now(),
            'expire_date' => isset($data['expirate_date']) ? $this->dateToTimestamp($data['expirate_date']) : Carbon::now()
        ])->save();

        return $lot;
    }
}