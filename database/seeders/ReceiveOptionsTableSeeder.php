<?php

namespace Database\Seeders;

use App\Models\ReceiveOption;
use Illuminate\Database\Seeder;

class ReceiveOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::getTempReceiveOptions() as $option) {
            ReceiveOption::create($option);
        }
    }

    /**
     * Get receive options temp data
     *
     * @return array
     */
    private static function getTempReceiveOptions()
    {
        return [
            ['period' => 'every 1 months'],
            ['period' => 'every 2 months'],
            ['period' => 'every 3 months']
        ];
    }
}
