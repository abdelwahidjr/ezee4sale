<?php

use App\Category;
use Illuminate\Database\Seeder;
use Faker\Factory;


class CategoriesTableSeeder extends Seeder
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
                $type = ['ad', 'market'];
                $type = $type[array_rand($type)];


                Category::create([
                    'name'          => $faker->name,
                    'price'         =>$faker->numberBetween(0,5000),
                    'ordering'      =>$faker->numberBetween(0,5000),
                    'adding_time'   =>$faker->numberBetween(0,5000),
                    'type'          => $type ,

                ]);
            }
        }
    }
}
