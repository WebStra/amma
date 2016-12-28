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
     * @var Vendor
     */
    protected $vendor;

    /**
     * RolesTableSeeder constructor.
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->instance = $role;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable();

        Role::create(['name' => 'member', 'active' => true, 'rank' => 1]);
        Role::create(['name' => 'admin', 'active' => true, 'rank' => 2]);
    }
}