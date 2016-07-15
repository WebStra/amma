<?php

use App\Repositories\FaqRepository;
use Faker\Factory as Faker;
use Keyhunter\Multilingual\LanguagesRepository;

class FaqTableSeeder extends Seeder
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
     * @var FaqRepository
     */
    protected $faqRepository;

    /**
     * @var LanguagesRepository
     */
    protected $languages;

    /**
     * @var \App\Faq
     */
    protected $instance;

    /**
     * FaqTableSeeder constructor.
     * @param FaqRepository $faqRepository
     * @param Faker $faker
     * @param LanguagesRepository $languagesRepository
     */
    public function __construct(
        FaqRepository $faqRepository,
        Faker $faker,
        LanguagesRepository $languagesRepository
    )
    {
        $this->count = 4;
        $this->faker = $faker->create();
        $this->languages = $languagesRepository;
        $this->faqRepository = $faqRepository;
        $this->instance = $this->faqRepository->getModel();
    }

    /**
     * Run database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable($this->faqRepository->getTranslatableModel());
        $this->deleteTable();

        for($i = 1; $i <= $this->count; $i++)
        {
            $faq = $this->instance->create([
                'rank' => $i
            ]);

            $this->languages->getPublic()
                ->each(function ($lang) use($faq) {
                    $this->faqRepository->getTranslatableModel()
                        ->create([
                            'faq_id' => $faq->id,
                            'language_id' => $lang->id,
                            'title' => $this->faker->sentence(random_int(3, 5)),
                            'body' => '<p>' . $this->faker->sentence(random_int(15, 32)) . '</p>'
                        ]);
                });
        }
    }
}