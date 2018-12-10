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

        if (app()->environment() !== 'production' && App::runningInConsole())
        {
            foreach (range(1 , 50) as $index)
            {
                Item::create([
                    'name'             => $faker->word ,
                    'price'            => rand(10 , 200) ,
                    'description'      => $faker->sentence(rand(5 , 10)) ,
                    'ingredient'       => [] ,
                    'image'            => asset('images/placeholder.png') ,
                    'video'            => 'https://youtu.be/Bey4XXJAqS8' ,
                    'views_number'     => 0 ,
                    'purchased_number' => 0 ,
                    'brand_id'         => rand(1 , 50) ,
                    'category_id'      => rand(1 , 50) ,
                    'menu_id'          => rand(1 , 50) ,
                    'promotion_id'     => rand(1 , 50) ,
                ]);
            }
        }
    }

}
