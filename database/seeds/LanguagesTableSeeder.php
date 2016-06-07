<?php

use Keyhunter\Multilingual\Language;

class LanguagesTableSeeder extends Seeder 
{

    /**
     * LanguagesTableSeeder constructor.
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->instance = $language;    
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable();

        $this->instance->create(['title' => 'Română',  'slug' => 'ro', 'active' => true, 'rank' => 1]);
        $this->instance->create(['title' => 'Русский', 'slug' => 'ru', 'active' => true, 'rank' => 2]);
        $this->instance->create(['title' => 'English', 'slug' => 'en', 'active' => true, 'rank' => 3]);
    }
}