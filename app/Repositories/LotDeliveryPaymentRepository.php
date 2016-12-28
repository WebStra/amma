<?php

namespace App\Repositories;

use App\LotDeliveryPayment;

class LotDeliveryPaymentRepository extends Repository
{
    /**
     * @return Banner
     */
    public function getModel()
    {
        return new LotDeliveryPayment();
    }

    /**
     * Get ad-blocks for extended banners block.
     *
     * @param $count
     * @return mixed
     */
    public function save($lot, array $data)
    {
        $model = self::getModel();
        $model->where('lot_id', $lot->id)->delete();
        $insert = []; $i = 0;
        if (!empty($data)) {
            foreach ($data as $key1 => $method) {
                foreach ($method as $key2 => $item) {
                    $insert[$i]['lot_id']      = $lot->id;
                    $insert[$i]['method_id']   = (int)$item;
                    $insert[$i]['method_type'] = $key1;
                    $i++;
                }

            }
            $model->insert($insert);
        }
        return true;
    }
}