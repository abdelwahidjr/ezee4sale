<?php

use App\Models\Review;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        if (app()->environment() !== 'production' && App::runningInConsole())
        {
            foreach (range(1 , 50) as $index)
            {
                Review::create([
                    'title'     => $faker->sentence($nbWords = rand(5 , 10)) ,
                    'body'      => $faker->sentence($nbWords = rand(10 , 20)) ,
                    'star'      => rand(1 , 5) ,
                    'user_id'   => rand(1 , 50) ,
                    'outlet_id' => rand(1 , 50) ,
                ]);
            }
        }
    }
}
