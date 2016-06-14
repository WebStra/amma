<?php


namespace App\Repositories;

use App\User;

class UserRepository extends Repository
{
    /**
     * @var RolesRepository
     */
    private $roles;

    /**
     * UserRepository constructor.
     * @param RolesRepository $rolesRepository
     */
    public function __construct(RolesRepository $rolesRepository)
    {
        $this->roles = $rolesRepository;
    }

    /**
     * @return User
     */
    public function getModel()
    {
        return new User();
    }

    /**
     * @param array $data
     * @return static
     */
    public function createSimpleUser(array $data)
    {
        return self::getModel()
            ->create([
                'email'     => $data['email'],
                'password'  => bcrypt($data['password']),
                'role_id'   => $this->getSimpleUser()->id
            ]);
    }

    public function createAdminUser(array $data)
    {
        return self::getModel()
            ->create([
                'email'     => $data['email'],
                'password'  => bcrypt($data['password']),
                'role_id'   => $this->getAdminRole()->id
            ]);
    }

    /**
     * @return mixed
     */
    public function getSimpleUser()
    {
        return $this->roles->getSimpleUserRole();
    }

    /**
     * @return mixed
     */
    public function getAdminRole()
    {
        return $this->roles->getAdminRole();
    }
}