<?php

use App\Currency;

class CurrencyTableSeeder extends Seeder
{
    /**
     * CurrencyTableSeeder constructor.
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->instance = $currency;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable();

        $this->instance->create([ 'title' => 'USD',  'sign' => '$', 'active' => true ]);
        $this->instance->create([ 'title' => 'EUR', 'sign' => '€', 'active' => true ]);
        $this->instance->create([ 'title' => 'MDL', 'sign' => 'MDL', 'active' => true ]);
    }
}