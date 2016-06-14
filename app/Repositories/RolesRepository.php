<?php

namespace App\Repositories;

use Keyhunter\Administrator\Model\Role;

class RolesRepository extends Repository
{
    /**
     * Administrator.
     */
    const ADMIN = 'admin';

    /**
     * Simple user role.
     */
    const USER = 'member';

    /**
     * @return Role
     */
    public function getModel()
    {
        return new Role();
    }

    /**
     * Get administrator role.
     *
     * @return mixed
     */
    public function getAdminRole()
    {
        return self::getModel()
            ->whereName(self::ADMIN)
            ->first();
    }

    /**
     * Get simple user's role.
     *
     * @return mixed
     */
    public function getSimpleUserRole()
    {
        return self::getModel()
            ->whereName(self::USER)
            ->first();
    }

    /**
     * Get all active roles.
     *
     * @return mixed
     */
    public function getPublic()
    {
        return self::getModel()
            ->whereActive(1)
            ->orderBy('rank', 'ASC')
            ->get();
    }
}