<?php

namespace App\Repositories;

use App\User;
use Auth;

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
        RolesRepository $rolesRepository = null,
        ProfileRepository $profileRepository = null
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
     * @return User
     */
    static public function staticGetModel()
    {
        return new User();
    }

    /**
     * @param array $data
     * @param int $confirmed
     * @return User
     */
    public function createSimpleUser(array $data, $confirmed = 0)
    {
        $user = self::getModel()
            ->create([
                'email' => $data['email'],
                'password' => $this->hashPassword($data['password']),
                'role_id' => $this->getSimpleUser()->id,
                'confirmation_code' => str_random(30),
                'confirmed' => $confirmed
            ]);

        $this->profile->getModel()->create([
            'user_id' => $user->id,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => isset($data['phone']) ? $data['phone'] : ''
        ]);

        return $user;
    }

    public function create(array $data)
    {
        return self::getModel()
            ->create($data);
    }
    
    /**
     * @param array $data
     * @return \App\User
     */
    public function createAdminUser(array $data)
    {
        return self::getModel()
            ->create([
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role_id' => $this->getAdminRole()->id,
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

    /**
     * @param $user
     */
    public function confirmate($user)
    {
        $user->confirmed = (int)true;
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
    public function getById($id)
    {
        return $this->getModel()
            ->whereId($id)
            ->first();
    }
    /**
     * @param array $data
     */
    public function update_user(array $data)
    {
        Auth::user()->update([
            'name' => $data['fname'],
            'email' => $data['email']
        ]);

        Auth::user()->profile->update([
            'firstname' => $data['fname'],
            'lastname' => $data['lname'],
            'phone' => $data['phone']
        ]);
    }

    /**
     * @param $password
     * @return string
     */
    public function hashPassword($password)
    {
        return bcrypt($password);
    }

    /**
     * @param $password
     */
    public function updatePassword($password)
    {
        Auth::user()->update([
            'password' => $this->hashPassword($password),
        ]);
    }

    /**
     * Check by email if user exists.
     *
     * @param $email
     * @return bool
     */
    public function checkIfUserExists($email)
    {
        return (bool)$this->getByEmail($email);
    }
}