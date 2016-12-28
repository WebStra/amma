<?php

use App\Repositories\PostsRepository;
use Faker\Factory as Faker;
use Keyhunter\Multilingual\LanguagesRepository;

class PostsTableSeeder extends Seeder
{
    /**
     * @var PostsRepository
     */
    protected $posts;

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Count of records for seed.
     *
     * @var int
     */
    protected $count;

    /**
     * Status types.
     *
     * @var array
     */
    protected $status = [
        'published', 'drafted'
    ];

    /**
     * @var LanguagesRepository
     */
    protected $languages;

    /**
     * PostsTableSeeder constructor.
     * @param PostsRepository $posts
     * @param Faker $factory
     */
    public function __construct(PostsRepository $posts, Faker $factory, LanguagesRepository $languagesRepository)
    {
        $this->instance = $posts->getModel();
        $this->posts = $posts;
        $this->faker = $factory->create();
        $this->count = rand(10, 11);
        $this->languages = $languagesRepository;
    }

    /**
     * Run database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable($this->posts->getTranslatableModel());

        $this->deleteTable();

        for($i = 1; $i < $this->count; $i++) {
            $post = $this->instance->create([
                'status' => $this->status[array_rand($this->status, 1)],
                'view_count' => rand(300, 301)
            ]);

            $this->languages->getPublic()->each(function ($language) use ($post){
                $title = $this->faker->word;

                $this->posts->getTranslatableModel()
                    ->create([
                        'post_id' => $post->id,
                        'language_id' => $language->id,
                        'title' => $title . '_' . $language->slug,
                        'body' => $this->faker->sentence(45),
                        'seo_title' => $title,
                        'seo_description' => $this->faker->sentence(4),
                        'seo_keywords' => sprintf('{"0":"%s", "1":"%s", "2":"%s"}', // jSon object.
                            $this->faker->word,
                            $title,
                            $this->faker->word
                        )
                    ]);
            });
        }
    }
}