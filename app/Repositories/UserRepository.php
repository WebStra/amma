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
     * @var 
     */
    private $profile;

    /**
     * UserRepository constructor.
     * @param RolesRepository $rolesRepository
     * @param ProfileRepository $profileRepository
     */
    public function __construct(
        RolesRepository $rolesRepository, 
        ProfileRepository $profileRepository
    )
    {
        $this->roles = $rolesRepository;
        $this->profile = $profileRepository;
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
        $user = self::getModel()
            ->create([
                'email'     => $data['email'],
                'password'  => bcrypt($data['password']),
                'role_id'   => $this->getSimpleUser()->id
            ]);
        
        $this->profile->getModel()->create([
            'user_id' => $user->id,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname']
        ]);

        return $user;
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