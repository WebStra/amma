<?php

namespace App\Repositories;

use App\Contacts;

class ContactsRepository extends Repository
{
    /**
     * @return Contacts
     */
    public function getModel()
    {
        return new Contacts();
    }

    /**
     * Create an contact request.
     *
     * @param array $data
     * @return static
     */
    public function sendContact(array $data)
    {
        return self::getModel()
            ->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'message' => $data['message'],
            ]);
    }
}