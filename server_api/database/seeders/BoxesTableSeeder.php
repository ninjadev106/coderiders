<?php

namespace Database\Seeders;

use App\Models\Box;
use Illuminate\Database\Seeder;

class BoxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::getTempBoxes() as $boxData) {
            $box = Box::create([
                'name'               => $boxData['name'],
                'description'        => $boxData['description'],
                'img'                => $boxData['img'],
                'resubscribe_period' => $boxData['resubscribe_period'],
                'free_shipping_from' => $boxData['free_shipping_from'],
            ]);

            $box->benefits()->sync($boxData['benefits']);

            foreach($boxData['products'] as $key => $product) {
                $box->products()->attach([$product => ['count' => !$key ? 3 : 2]]);
            }
        }
    }

    /**
     * Get boxes temp data
     *
     * @return array
     */
    private static function getTempBoxes()
    {
        return [
            [
                'name'               => 'single',
                'description'        => 'single',
                'img'                => '0.svg',
                'resubscribe_period' => 3,
                'free_shipping_from' => 900,
                'benefits'           => [1,2,3],
                'products'           => [1,2,3,8]
            ],
            [
                'name'               => 'large',
                'description'        => 'large family',
                'img'                => '1.svg',
                'resubscribe_period' => 2,
                'free_shipping_from' => 600,
                'benefits'           => [1,2,3,4,5,6],
                'products'           => [1,2,3,8]
            ],
            [
                'name'               => 'companies',
                'description'        => 'large family',
                'img'                => '2.svg',
                'resubscribe_period' => 1,
                'free_shipping_from' => 300,
                'benefits'           => [1,2,3,4,5,6,7,8,9],
                'products'           => [1,2,3,8]
            ]
        ];
    }
}
