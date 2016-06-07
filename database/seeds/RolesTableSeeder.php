<?php

use App\Seller;
use App\User;
use App\UserProducts;
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
     * @var Seller
     */
    protected $seeler;


    /**
     * RolesTableSeeder constructor.
     * @param Role $role
     * @param User $user
     * @param UserProducts $usersProducts
     * @param Seller $seller
     */
    public function __construct(Role $role, User $user, UserProducts $usersProducts, Seller $seller)
    {
        $this->instance = $role;
        $this->user = $user;
        $this->usersProducts = $usersProducts;
        $this->seeler = $seller;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable($this->usersProducts);
        $this->deleteTable($this->seeler);
        $this->deleteTable($this->user);
        $this->deleteTable();

        Role::create(['name' => 'member', 'active' => true, 'rank' => 1]);
        Role::create(['name' => 'admin', 'active' => true, 'rank' => 2]);
    }
}