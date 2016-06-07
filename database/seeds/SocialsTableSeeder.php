<?php

use App\Social;

class SocialsTableSeeder extends Seeder
{
    /**
     * Socials for seed.
     *
     * @var array
     */
    protected $socials = [
        ['link' => 'http://facebook.com/', 'key' => 'facebook'],
        ['link' => 'http://twitter.com/', 'key' => 'twitter'],
        ['link' => 'http://ok.ru/', 'key' => 'odnoklassniki'],
        ['link' => 'http://vk.com/', 'key' => 'vkontakte'],
        ['link' => 'http://google.com/', 'key' => 'google-plus'],
    ];

    /**
     * SocialsTableSeeder constructor.
     * @param Social $social
     */
    public function __construct(Social $social)
    {
        $this->instance = $social;
    }

    /**
     * Run for seed.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable();

        array_walk($this->socials, function ($social) {
            $this->instance->create($social);
        });
    }
}