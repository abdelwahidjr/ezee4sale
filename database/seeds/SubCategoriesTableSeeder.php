<?php

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Faker\Factory;

class SubCategoriesTableSeeder extends Seeder
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
        if (app()->environment() !== 'production' && App::runningInConsole()) {
            foreach (range(1, 50) as $index) {
                $type = ['ad', 'market'];
                $type = $type[array_rand($type)];


                SubCategory::create([
                    'name' => $faker->name,
                    'ordering' => $faker->numberBetween(0, 5000),
                    'type' => $type,
                    'category_id' => $faker->randomElement($catigories_ids)

                ]);
            }
        }
    }
}

