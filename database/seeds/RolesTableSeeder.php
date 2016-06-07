<?php

use App\User;
use Keyhunter\Administrator\Model\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * @var User
     */
    protected $user;

    /**
     * RolesTableSeeder constructor.
     * @param Role $role
     * @param User $user
     */
    public function __construct(Role $role, User $user)
    {
        $this->instance = $role;
        $this->user = $user;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable($this->user);
        $this->deleteTable();

        Role::create(['name' => 'member', 'active' => true, 'rank' => 1]);
        Role::create(['name' => 'admin', 'active' => true, 'rank' => 2]);
    }
}