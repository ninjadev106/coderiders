<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::getTempCategoriesList() as $category) {
            Category::create($category);
        }
    }

    /**
     * Get products temp data
     *
     * @return array
     */
    private static function getTempCategoriesList()
    {
        return [
            ['title' => 'Attractions'],
            ['title' => 'Dining'],
            ['title' => 'Education'],
            ['title' => 'Family'],
            ['title' => 'Health'],
            ['title' => 'Office'],
            ['title' => 'Promotions'],
        ];
    }
}
