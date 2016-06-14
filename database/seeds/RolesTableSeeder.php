<?php

use App\User;
use App\UserProducts;
use App\Vendor;
use Keyhunter\Administrator\Model\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var UserProducts
     */
    protected $usersProducts;

    /**
     * @var Vendor
     */
    protected $vendor;


    /**
     * RolesTableSeeder constructor.
     * @param Role $role
     * @param User $user
     * @param UserProducts $usersProducts
     * @param Vendor $vendor
     */
    public function __construct(Role $role, User $user, UserProducts $usersProducts, Vendor $vendor)
    {
        $this->instance = $role;
        $this->user = $user;
        $this->usersProducts = $usersProducts;
        $this->vendor = $vendor;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable($this->usersProducts);
        $this->deleteTable($this->vendor);
        $this->deleteTable($this->user);
        $this->deleteTable();

        Role::create(['name' => 'member', 'active' => true, 'rank' => 1]);
        Role::create(['name' => 'admin', 'active' => true, 'rank' => 2]);
    }
}