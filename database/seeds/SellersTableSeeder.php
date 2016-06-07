<?php

use App\Seller;
use App\User;
use Faker\Factory as Faker;

class SellersTableSeeder extends Seeder
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
     * SellersTableSeeder constructor.
     * @param Seller $seller
     * @param $faker
     * @param User $user
     */
    public function __construct(Seller $seller, Faker $faker, User $user)
    {
        $this->instance = $seller;
        $this->faker = $faker->create();
        $this->user = $user;
    }

    public function run()
    {
        $this->deleteTable();

        $this->user
            ->all()
            ->each(function ($user) {
                $count_sellers = rand(1, 3);
                for($i = 0; $i < $count_sellers; $i++) {
                    $this->instance->create([
                        'user_id' => $user->id,
                        'name' => $this->faker->sentence(2),
                        'phone' => $this->faker->phoneNumber,
                        'description' => $this->faker->sentence(10),
                        'active' => 1
                    ]);
                }
            });
    }
}