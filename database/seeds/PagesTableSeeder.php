<?php

use Faker\Factory as Faker;
use Keyhunter\Administrator\Model\Page;
use Keyhunter\Administrator\Model\PageTranslation;
use Keyhunter\Multilingual\Language;

class PagesTableSeeder extends Seeder
{
    /**
     * @var PageTranslation
     */
    protected $page_translation;

    /**
     * @var Faker
     */
    protected $faker;

    /**
     * @var Keyhunter\Multilingual\Language
     */
    protected $language;

    /**
     * PagesTableSeeder constructor.
     *
     * @param Page $page
     * @param PageTranslation $page_translation
     * @param Faker $faker
     * @param Language $language
     */
    public function __construct(
        Page $page,
        PageTranslation $page_translation,
        Faker $faker,
        Language $language
    )
    {
        $this->instance = $page;
        $this->page_translation = $page_translation;
        $this->faker = $faker->create();
        $this->language = $language;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable($this->page_translation);
        $this->deleteTable();

        $pages = [];
        for ($i = 0; $i <= 3; $i++) {
            $pages[] = $this->instance->create([
                'slug' => $this->faker->word,
                'active' => 1
            ]);
        }

        $this->language
            ->whereActive(1)
            ->get()
            ->each(function ($language) use ($pages) {
                array_walk($pages, function ($page) use ($language) {
                    $this->page_translation->create([
                        'language_id' => $language->id,
                        'page_id' => $page->id,
                        'title' => $this->faker->title,
                        'body' => $this->faker->text(150)
                    ]);
                });
            });
    }
}