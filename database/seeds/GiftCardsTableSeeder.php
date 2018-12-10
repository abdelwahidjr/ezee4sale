<?php

use App\Models\GiftCard;
use Faker\Factory;
use Illuminate\Database\Seeder;

class GiftCardsTableSeeder extends Seeder
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

                GiftCard::create([
                    'name'        => $faker->word ,
                    'description' => $faker->sentence(rand(5 , 20)) ,
                    'amount'      => rand(100 , 1000) ,
                    'status'      => 'activated' ,
                    'expire_date' => $date ,
                    'user_id' => rand(1,50)
                ]);
            }
        }
    }

}

