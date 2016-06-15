<?php

use App\Profile;
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
     * @var \App\Profile
     */
    protected $profile;

    /**
     * UsersTableSeeder constructor.
     * @param User $user
     * @param Faker $faker
     * @param Role $role
     * @param Profile $profile
     */
    public function __construct(
        User $user, Faker $faker, Role $role, Profile $profile
    )
    {
        $this->instance = $user;
        $this->faker = $faker->create();
        $this->role = $role;
        $this->profile = $profile;
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
                    $user = $this->instance->create([
                        'name' => $this->faker->name,
                        'email' => $this->faker->email,
                        'role_id' => $role->id,
                        'password' => \Hash::make($this->faker->word . $this->faker->phoneNumber)
                    ]);

                    $this->profile->create([
                        'user_id' => $user->id,
                        'firstname' => $this->faker->firstNameFemale,
                        'lastname' => $this->faker->lastName,
                        'phone' => $this->faker->phoneNumber
                    ]);
                }
            });

        $admin = $this->instance->create([
            'name' => 'Admin',
            'email' => 'admin@amma.com',
            'role_id' => $this->role->whereName('admin')->first()->id,
            'password' => Hash::make('admin')
        ]);

        $this->profile->create([
            'user_id' => $admin->id,
            'firstname' => 'Joth',
            'lastname' => 'Haythem',
            'phone' => '0 000 000 0'
        ]);
    }
}