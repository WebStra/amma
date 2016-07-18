<?php

use Keyhunter\Administrator\Model\Settings;

class OptionsTableSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data_seed = [
        'site' => [
            'admin::email'   => 'keyhunter@gmail.com',
            'site::name'     => 'Test Admin Panel',
            'site::about'    => 'About site',
            'site::down'     => '1',
            'support::email' => 'amma@support.com',
            'support::skype' => 'ammaskype',
            'support::phone' => '(+373) 69 845 100',
            'contact_map::coords' => '51.090046, -114.686670',
            'contact_info::adress' => 'mun. Chișinău, str. Mihai Viteazu 43',
            'contact_info::email' => 'info@ecommerce.md',
            'contact_info::executivPhone' => '+373 69 221 478',
            'contact_info::sellPhone' => '+373 69 221 478',
            'contact_info::tehnicPhone' => '+373 69 221 478',
        ],
        'test' => [
            'option::test_1' => 'test1',
            'option::test_2' => 'test1'
        ]
        /*
         * 'group' => [
         *     'key_1' => 'value',
         *     'key_2' => 'value'
         * ]
         */
    ];

    /**
     * OptionsTableSeeder constructor.
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->instance = $settings;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable();

        array_walk($this->data_seed, function ($keys, $group) {
            array_walk($keys, function($value, $key) use ($group) {
                $this->instance->create([
                    'key'   => $key,
                    'value' => $value,
                    'group' => $group
                ]);
            });
        });
    }
}