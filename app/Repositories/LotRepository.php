<?php

namespace App\Repositories;

use App\Lot;
use App\Vendor;
use Carbon\Carbon;

/**
 * Class LotRepository
 * @package App\Repositories
 */
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
            ->create([
                'vendor_id' => $vendor->id
            ]);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function find($slug)
    {
        if (is_numeric($slug))
            return $this->getModel()
                ->whereId((int) $slug)
                ->first();

        return $this->getModel()
            ->whereSlug($slug)
            ->first();
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
            $query = $query->where('vendor_id', $vendor->id);

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
            ->where('status', $model::STATUS_COMPLETE)
            ->orderByRaw("FIELD(sell_status, \"default\", \"declined\", \"accept\")")
            ->orderByRaw("FIELD(verify_status, \"drafted\", \"declined\", \"pending\", \"expired\", \"verified\")")
            ->orderBy('expire_date', self::ASC)
            ->paginate($perPage);

        return ($lots->count()) ? $lots : null;
    }

    /**
     * @param $user
     * @param null $lotId
     * @return int
     */
    public function userLotsPendingComision($user, $lotId=null)
    {

        $model = self::getModel();

        $vendors = [];
        $user->vendors()->active()->get()
            ->each(function($vendor) use (&$vendors){
                $vendors[] = $vendor->id;
            });
        $query = $this->getModel()->where('verify_status', $model::STATUS_VERIFY_PENDING);
        if (!empty($vendors)) {
            $query->whereIn('vendor_id', $vendors);
        }
        if ($lotId != null) {
            $query->where('id','!=', $lotId);
        }
        $sum = $query->sum('comision');
        return  $sum ? (int)$sum : 0;
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
     * Update status lot.
     *
     * @param $lot
     */
    public function updateExpiredStatus($status)
    {
       $this->getModel()->where('expired_status', 'No')->where('expire_date', '<=', Carbon::now())->update(['verify_status'=>$status,'expired_status'=>'Yes']);
    }

    /**
     *
     */
    public function getExpiredLot()
    {
        $this->getModel()->where('expired_status', 'No')->where('expire_date', '<=', Carbon::now())->get();
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

        if(count($datas) == 3) {
            $new_date['d'] = $datas[0];
            $new_date['m'] = $datas[1];
            $new_date['y'] = $datas[2];
        } else {
            $now = Carbon::now();
            $new_date['d'] = $now->day;
            $new_date['m'] = $now->month;
            $new_date['y'] = $now->year;
        }

        return $new_date;
    }

    /**
     * @param $lot
     * @param array $data
     * @return mixed
     */
    public function save($lot, array $data)
    {
        $lot->fill([
            'name'                 => isset($data['name']) ? $data['name'] : $lot->present()->renderDraftedName(),
            'category_id'          => isset($data['category']) ? $data['category'] : null,
            'currency_id'          => isset($data['currency']) ? (int)$data['currency'] : null,
            'description'          => isset($data['description']) ? $data['description'] : null,
            'yield_amount'         => isset($data['yield_amount']) ? $data['yield_amount'] : null,
            'public_date'          => isset($data['public_date']) ? $this->dateToTimestamp($data['public_date']) : Carbon::now()->addDays(1),
            'expire_date'          => isset($data['expirate_date']) ? $this->dateToTimestamp($data['expirate_date']) :Carbon::now()->addDays(5),
            'comision'             => isset($data['comision']) ? $data['comision'] : 0,
            'description_delivery' => isset($data['description_delivery']) ? $data['description_delivery'] : null,
            'description_payment'  => isset($data['description_payment']) ? $data['description_payment'] : null,
        ])->save();
        return $lot;
    }


    /**
     * Change category.
     *
     * @param $lot
     * @param $category_id
     *
     * @return void
     */
    public function changeCategory($lot, $category_id)
    {
        $lot->fill([
            'category_id' => $category_id
        ])->save();
    }

    /**
     * Check if user can to change category.
     *
     * @param Lot $lot
     * @return bool
     */
    public function checkIfPossibleToChangeCategory(Lot $lot)
    {
        if(! count($lot->products))
            return true;

        return false;
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function getLatestLot($limit = 10)
    {
        return self::getModel()
            ->where('verify_status','verified')
            ->where('expire_date', '>', Carbon::now())
            ->orderBy('id','DESC')
            ->active()
            ->limit($limit)
            ->get();
    }

    /**
     * @param int $paginate
     * @return mixed
     */
    public function getExpireSoon($paginate = 10)
    {
        $query = $this->getModel()
            ->select('lots.*')
            ->where('lots.active', 1)
            ->where('verify_status','verified')
            ->where('lots.expire_date', '>', Carbon::now())
            ->orderBy('lots.expire_date', self::ASC);

        return $query->paginate($paginate);
    }

    /**
     * @param $status
     * @return mixed
     */
    public function getByStatus($status){
        return self::getModel()
            ->where('verify_status',$status)
            ->count();

    }

}