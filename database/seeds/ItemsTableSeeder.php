<?php

use App\Models\Item;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        if (app()->environment() !== 'production' && App::runningInConsole()) {
            foreach (range(1, 50) as $index) {

                Item::create([
                    'title' => $faker->name,
                    'type' => array_random(['ad', 'market']),
                    'user_id' => rand(1, 50),
                    'whats_app' => $faker->phoneNumber,
                    'place' => $faker->address,
                    'phone' => $faker->phoneNumber,
                    'category_id' => rand(1, 50),
                    'sub_category_id' => rand(1, 50),
                    'views_count' => rand(1, 50),
                    'state' => array_random(['pinned', 'featured', 'none']),
                    'appear_on_home' => array_random([true, false]),
                ]);
            }
        }
    }
}
