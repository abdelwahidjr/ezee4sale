<?php

use App\Models\Extra;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ExtrasTableSeeder extends Seeder
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
                Extra::create([
                    'name'        => $faker->name ,
                    'description' => $faker->name ,
                    'price'       => rand(10 , 100) ,
                    'item_id'     => rand(1 , 50) ,
                ]);
            }
        }

    }

}
