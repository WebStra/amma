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
    
    static public function staticGetModel()
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
                'role_id'   => $this->getSimpleUser()->id,
                'confirmation_code' => str_random(30)
            ]);
        
        $this->profile->getModel()->create([
            'user_id' => $user->id,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone']
        ]);

        return $user;
    }

    public function createAdminUser(array $data)
    {
        return self::getModel()
            ->create([
                'email'     => $data['email'],
                'password'  => bcrypt($data['password']),
                'role_id'   => $this->getAdminRole()->id,
                'confirmed' => 1
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

    /**
     * Get user by confirmation code.
     * 
     * @param $code
     * @return mixed
     */
    public function getByConfirmationCode($code)
    {
        return self::getModel()
            ->where('confirmation_code', $code)
            ->first();
    }

    public function confirmate($user)
    {
        $user->confirmed = (int) true;
        $user->save();
    }

    /**
     * Get user by email.
     *
     * @param $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        return $this->getModel()
            ->whereEmail($email)
            ->first();
    }
}