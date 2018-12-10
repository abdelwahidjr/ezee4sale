<?php

use App\Models\FAQ;
use Faker\Factory;
use Illuminate\Database\Seeder;

class FAQsTableSeeder extends Seeder
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

                FAQ::create([
                    'question' => $faker->sentence($nbWords = rand(5 , 15)) ,
                    'answer'   => $faker->sentence($nbWords = rand(20 , 40)) ,
                    'priority' => rand(1 , 5) ,
                ]);
            }
        }
    }

}
