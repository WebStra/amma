<?php

class DatabaseSeeder extends Seeder
{
    /**
     * Seeds.
     *
     * @var array
     */
    protected $seeds = [
        LanguagesTableSeeder::class,
        OptionsTableSeeder::class,
        RolesTableSeeder::class,
        PartnersTableSeeder::class,
        SocialsTableSeeder::class,
        BannersTableSeeder::class,
        UsersTableSeeder::class,
        PagesTableSeeder::class,
        VendorsTableSeeder::class,
        ProductsTableSeeder::class,
        CategoriesTableSeeder::class,
        PostsTableSeeder::class
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        array_walk($this->seeds, function ($seed) {
            $this->call($seed);
        });
    }
}
