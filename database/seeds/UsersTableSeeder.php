<?php

use Keyhunter\Administrator\Model\Role;
use Keyhunter\Administrator\Model\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * @var Faker
     */
    protected $faker;

    /**
     * @var Role
     */
    protected $role;

    /**
     * UsersTableSeeder constructor.
     * @param User $user
     * @param Faker $faker
     * @param Role $role
     */
    public function __construct(User $user, Faker $faker, Role $role)
    {
        $this->instance = $user;
        $this->faker = $faker->create();
        $this->role = $role;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable();
        
        $this->role
            ->whereActive(1)
            ->get()
            ->each(function ($role, $key) {
                for ($i = 0; $i < 3; $i++) {
                    $this->instance->create([
                        'name' => $this->faker->name,
                        'email' => $this->faker->email,
                        'role_id' => $role->id,
                        'password' => \Hash::make($this->faker->word . $this->faker->phoneNumber)
                    ]);
                }
            });

        $this->instance->create([
            'name' => 'Keyhunter',
            'email' => 'keyhunter@gmail.com',
            'role_id' => $this->role->whereName('admin')->first()->id,
            'password' => Hash::make('admin123')
        ]);
    }
}