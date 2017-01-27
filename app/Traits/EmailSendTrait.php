<?php

namespace App\Traits;
use Illuminate\Mail\Message;

/**
 * Class EmailSendTrait
 * @package App\Traits
 */
trait EmailSendTrait
{


    /**
     * @param $lot
     * @return array
     */
    public function userInvolvedList($lot)
    {
        $array = [];

        foreach ($lot->involved as $item) {

            $array[] = [
                'user' => [
                    'id' => $item->user->id,
                    'firstname' => $item->user->profile->firstname,
                    'lastname' => $item->user->profile->lastname,
                    'email' => $item->user->email,
                    'phone' => $item->user->profile->phone,
                    'count' => $item->count,
                    'product_hash' => $item->product_hash,
                ],
            ];
        }
        return $array;
    }

    /**
     * @param $lot
     * @return array
     */
    public function getUserProducstInvolved($lot)
    {
        $array = [];

        foreach ($lot->involved->unique('user_id') as $item) {
            $array[] = [
                'user' => [
                    'id'        => $item->user->id,
                    'firstname' => $item->user->profile->firstname,
                    'lastname'  => $item->user->profile->lastname,
                    'email'     => $item->user->email,
                    'phone'     => $item->user->profile->phone,
                    'count'     => $item->count,
                    'products'  => $this->getProductsInvolved($item->lot_id, $item->user_id)
                ],
            ];
        }
        return $array;
    }

    /**
     * @param $lot_id
     * @param $user_id
     * @return array
     */
    public function getProductsInvolved($lot_id, $user_id)
    {
        $products = [];
        $getUserInvolved = $this->involved->getUserInvolved($lot_id, $user_id);
        foreach ($getUserInvolved as $item) {
            $products[] = [
                'name'         => $item->specPrice->name,
                'price'        => $item->specPrice->new_price,
                'count'        => $item->count,
                'color'        => $item->involvedColor->color_hash,
                'size'         => $item->improvedSpec->size,
                'product_hash' => $item->product_hash,
                'total' => $item->specPrice->new_price * $item->count,
            ];
        }
        return $products;
    }
    /**
     * @param $lot
     */
    public function sendVendorMessage($lot)
    {
        $users = $this->userInvolvedList($lot);

        \Mail::send('emails.lot-expired-vendor', compact('users','lot'), function (Message $message) use ($users, $lot) {
            $message->to($lot->vendor->email)
                ->subject("Lotul a expirat");
        });
    }

    /**
     * @param $lot
     */

    public function sendUsersMessage($lot)
    {

        $users = $this->getUserProducstInvolved($lot);

        $vendor = $lot->vendor;

        foreach($users as $user)
        {
            $email = $user['user']['email'];

            $products =$user['user']['products'];

            \Mail::send('emails.lot-expired-users', compact('vendor','lot','products'), function (Message $message) use ($email,$vendor,$lot,$products) {
                $message->to($email)->subject('Oferta este finisata!');
            });
        }

    }
}