<?php

use App\Models\Cart;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        if (app()->environment() !== 'production' && App::runningInConsole())
        {
            foreach (range(1 , 50) as $index)
            {
                cart::create([
                    'item'  => [] ,
                    'notes' => $faker->sentence($nbWords = 5) ,
                ]);
            }
        }
    }

}
