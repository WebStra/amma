<?php

use App\Vendor;
use App\User;
use Faker\Factory as Faker;

class VendorsTableSeeder extends Seeder
{
    /**
     * @var Faker
     */
    protected $faker;

    /**
     * @var \App\User
     */
    protected $user;

    /**
     * VendorsTableSeeder constructor.
     * @param Vendor $vendor
     * @param $faker
     * @param User $user
     */
    public function __construct(Vendor $vendor, Faker $faker, User $user)
    {
        $this->instance = $vendor;
        $this->faker = $faker->create();
        $this->user = $user;
    }

    public function run()
    {
        $this->deleteTable();

        $this->user->all()
            ->each(function ($user) {
                $count = rand(1, 3);
                for($i = 0; $i < $count; $i++) {
                    $this->instance->create([
                        'user_id' => $user->id,
                        'name' => $this->faker->sentence(2),
                        'email' => $this->faker->email,
                        'phone' => $this->faker->phoneNumber,
                        'description' => $this->faker->sentence(10),
                        'active' => 1
                    ]);
                }
            });
    }
}