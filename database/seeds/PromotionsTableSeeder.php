<?php

use App\Models\Promotion;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
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

                $date = new DateTime('today');
                $date->modify('+' . rand(100 , 200) . 'day');
                $date->format('Y-m-d');

                Promotion::create([
                    'name'                  => $faker->word ,
                    'description'           => $faker->sentence(rand(5 , 20)) ,
                    'type'                  => $faker->word ,
                    'percentage'            => rand(5 , 10) ,
                    'expire_date'           => $date ,
                    'buy_one_get_one_offer' => 'off' ,

                ]);
            }
        }
    }

}
