<?php

use App\Models\Coupon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
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

                Coupon::create([
                    'code'        => $faker->word ,
                    'description' => $faker->sentence(rand(5 , 20)) ,
                    'type'        => $faker->word ,
                    'percentage'  => rand(5 , 10) ,
                    'amount'      => rand(10 , 50) ,
                    'expire_date' => $date ,
                    'used'        => 'no' ,
                    'limit'       => rand(1 , 50) ,
                    'event_id'    => rand(1 , 50) ,
                ]);
            }
        }
    }

}

