<?php

namespace App\Repositories;

use App\Contacts;
use Auth;

class ContactsRepository extends Repository
{
    /**
     * @return 
     */
    public function getModel()
    {
        return new Contacts();
    }


public function sendContact(array $data) {

return self::getModel()
            ->create([
                'name'     => $data['name'],
                'email'  => $data['email'],
                'phone'  => $data['phone'],
                'message'  => $data['message'],
            ]);

        }


}