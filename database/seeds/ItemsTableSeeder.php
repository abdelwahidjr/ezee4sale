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
        $catigories_ids = DB::table('categories')->pluck('id');
        $subcatigories_ids = DB::table('sub_categories')->pluck('id');
        if (app()->environment() !== 'production' && App::runningInConsole()) {
            foreach ($catigories_ids as $catigories_id) {
                foreach ($subcatigories_ids as $subcatigories_id) {

                    Item::create([
                        'title' => $faker->name,
                        'type' => array_random(['ad', 'market']),
                        'user_id' => rand(1, 50),
                        'whats_app' => $faker->phoneNumber,
                        'place' => $faker->address,
                        'phone' => $faker->phoneNumber,
                        'due_date' => $faker->dateTimeBetween('yesterday', '+10 day'),
                        'category_id' => $faker->randomElement($catigories_ids),
                        'sub_category_id' => $faker->randomElement($subcatigories_ids),
                        'views_count' => rand(1, 50),
                        'state' => array_random(['pinned', 'featured', 'none']),
                        'appear_on_home' => array_random([true, false]),
                    ]);
                }
            }
        }
    }
}
