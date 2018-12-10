<?php

use App\Models\Area;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
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
                Area::create([
                    'name_ar' => $faker->city ,
                    'name_en' => $faker->city ,
                    'name_fr' => $faker->city ,
                    'city_id' => rand(1 , 20) ,
                ]);
            }
        }
    }

}
