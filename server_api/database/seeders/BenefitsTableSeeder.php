<?php

namespace Database\Seeders;

use App\Models\Benefit;
use Illuminate\Database\Seeder;

class BenefitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::getTempBenefits() as $benefit) {
            Benefit::create($benefit);
        }
    }

    /**
     * Get benefits temp data
     *
     * @return array
     */
    private static function getTempBenefits()
    {
        return [
            [
                'image' => 'box.svg',
                'name'  => 'Free shipping',
                'cost'  => 20,
            ],
            [
                'image' => 'edit.svg',
                'name'  => 'Free edit plan',
                'cost'  => 20,
            ],
            [
                'image' => 'edit.svg',
                'name'  => 'Free changing',
                'cost'  => 29,
            ],
            [
                'image' => 'money_back.svg',
                'name'  => 'Money back',
                'cost'  => 3,
            ],
            [
                'image' => 'clock_icon.svg',
                'name'  => 'Rough hours shipping',
                'cost'  => 3,
            ],
            [
                'image' => 'box.svg',
                'name'  => 'Free shipping + bonus',
                'cost'  => 4,
            ],
            [
                'image' => 'edit.svg',
                'name'  => 'Free edit plan + bonus',
                'cost'  => 5,
            ],
            [
                'image' => 'edit.svg',
                'name'  => 'Free changing + bonus',
                'cost'  => 5,
            ],
            [
                'image' => 'money_back.svg',
                'name'  => 'Money back + bonus',
                'cost'  => 10,
            ],
            [
                'image' => 'clock_icon.svg',
                'name'  => 'Rough hours shipping + bonus',
                'cost'  => 10,
            ]
        ];
    }
}
