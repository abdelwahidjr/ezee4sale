<?php

use App\Models\Favorite;
use Faker\Factory;
use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
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
                Favorite::create([
                    'name'        => $faker->word ,
                    'description' => $faker->sentence(rand(10 , 100)) ,
                    'user_id'     => rand(1 , 50) ,
                    'item'        => [] ,
                ]);
            }
        }
    }

}
