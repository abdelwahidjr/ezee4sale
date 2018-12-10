<?php

use App\Models\Newsletter;
use Faker\Factory;
use Illuminate\Database\Seeder;

class NewslettersTableSeeder extends Seeder
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
                Newsletter::create([
                    'title'   => $faker->word ,
                    'type'    => $faker->word ,
                    'body'    => $faker->sentence(rand(5 , 10)) ,
                    'send_to' => [] ,
                ]);
            }
        }
    }

}

