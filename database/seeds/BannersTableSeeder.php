<?php

use App\Banner;
use Faker\Factory as Faker;

class BannersTableSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * @var int
     */
    protected $count;

    /**
     * BannersTableSeeder constructor.
     * @param Banner $banner
     * @param Faker $faker
     */
    public function __construct(Banner $banner, Faker $faker)
    {
        $this->instance = $banner;
        $this->faker = $faker->create();
        $this->count = rand(6, 11);
    }

    /**
     * Run database seed.
     * 
     * @return void
     */
    public function run()
    {
        $this->deleteTable();

        for($i = 1; $i <= $this->count; $i++) {
            $this->instance->create([
                'link' => $this->faker->url,
                'image_url' => $this->faker->imageUrl(580, 230),
                'rank' => $i
            ]);
        }
    }
}