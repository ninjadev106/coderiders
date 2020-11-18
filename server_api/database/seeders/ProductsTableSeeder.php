<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::getTempProductsList() as $product) {
            Product::create($product);
        }
    }

    /**
     * Get products temp data
     *
     * @return array
     */
    private static function getTempProductsList()
    {
        return [
            [
                'title'       => 'Beautifully Design Red Dress',
                'description' => 'Is simply dummy text of the printing and typesetting industry.',
                'price'       => 150,
                'rating'      => 4,
                'img'         => '9.jpg',
                'category_id' => 1
            ],
            [
                'title'       => 'Stretchable Jeans',
                'description' => 'Is simply dummy text of the printing and typesetting industry.',
                'price'       => 88,
                'rating'      => 3.5,
                'img'         => '13.jpg'
            ],
            [
                'title'       => 'Peacock Design Kurti',
                'description' => 'Is simply dummy text of the printing and typesetting industry.',
                'price'       => 70,
                'rating'      => 1,
                'img'         => '14.jpg'
            ],
            [
                'title'       => 'Dapibus in Scalf',
                'description' => 'Is simply dummy text of the printing and typesetting industry.',
                'price'       => 35,
                'rating'      => 2,
                'img'         => '4.jpg'
            ],
            [
                'title'       => 'Maroon Shorty',
                'description' => 'Is simply dummy text of the printing and typesetting industry.',
                'price'       => 98,
                'rating'      => 0,
                'img'         => '19.jpg'
            ],
            [
                'title'       => 'Maroon Shorty',
                'description' => 'Is simply dummy text of the printing and typesetting industry.',
                'price'       => 98,
                'rating'      => 1.2,
                'img'         => '7.jpg'
            ],
            [
                'title'       => 'Antique Short Dress',
                'description' => 'Is simply dummy text of the printing and typesetting industry.',
                'price'       => 88,
                'rating'      => 4.2,
                'img'         => '17.jpg'
            ],
            [
                'title'       => 'Black Lowest Jeans',
                'description' => 'Is simply dummy text of the printing and typesetting industry.',
                'price'       => 110,
                'rating'      => 3.5,
                'img'         => '10.jpg'
            ],
        ];
    }
}
