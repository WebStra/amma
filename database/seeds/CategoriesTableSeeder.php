<?php

use App\Repositories\CategoryRepository;
use App\Repositories\ProductsRepository;
use Faker\Factory as Faker;
use Keyhunter\Multilingual\LanguagesRepository;


class CategoriesTableSeeder extends Seeder
{
    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * @var LanguagesRepository
     */
    protected $languages;

    /**
     * @var ProductsRepository
     */
    protected $products;

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Count seed of records.
     *
     * @var int
     */
    protected $count;

    /**
     * CategoriesTableSeeder constructor.
     * @param CategoryRepository $categoryRepository
     * @param LanguagesRepository $languagesRepository
     * @param ProductsRepository $productsRepository
     * @param Faker $faker
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        LanguagesRepository $languagesRepository,
        ProductsRepository $productsRepository,
        Faker $faker)
    {
        $this->categories = $categoryRepository;
        $this->languages = $languagesRepository;
        $this->instance = $categoryRepository->getModel();
        $this->faker = $faker->create();
        $this->count = rand(10, 11);
        $this->products = $productsRepository;
    }

    /**
     * Run database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteTable($this->categories->getTranslatableModel());
        $this->deleteTable($this->categories->getCategoryableModel());
        $this->deleteTable();

        for($i = 1; $i < $this->count; $i++) {
            $category = $this->createInstanceRecord($i);
            
            $this->getLanguages()->each(function ($language) use ($category){
                $title = $this->faker->word;
                $this->categories->getTranslatableModel()
                    ->create([
                        'category_id' => $category->id,
                        'language_id' => $language->id,
                        'name' => $title . '_' . $language->slug,
                        'seo_title' => $title,
                        'seo_description' => $this->faker->sentence(4),
                        'seo_keywords' => sprintf('{"0":"%s", "1":"%s", "2":"%s"}', // jSon object.
                            $this->faker->word,
                            $title,
                            $this->faker->word
                        )
                    ]);
            });

            $this->products->getSomeRandomProducts()->each(function ($product) use ($category){
                $this->categories->getCategoryableModel()
                    ->create([
                        'categoryable_id' => $product->id,
                        'categoryable_type' => get_class($this->products->getModel()),
                        'category_id' => $category->id,
                        'type' => 'parent'
                    ]);
            });
        }
    }

    /**
     * Get active languages.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getLanguages()
    {
        return $this->languages->getPublic();
    }

    /**
     * Create instance row.
     *
     * @param $increment
     * @return static
     */
    private function createInstanceRecord($increment)
    {
        return $this->instance->create([
            'show_in_sidebar' => 1,
            'show_in_footer' => rand(0, 1),
            'rank' => $increment
        ]);
    }
}