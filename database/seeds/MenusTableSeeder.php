<?php

use App\Models\Menu;
use Faker\Factory;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
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

                Menu::create([
                    'name'        => $faker->name ,
                    'description' => $faker->name ,
                    'image'       => [] ,
                    'brand_id'    => rand(1 , 50) ,
                ]);
            }
        }
    }


}
