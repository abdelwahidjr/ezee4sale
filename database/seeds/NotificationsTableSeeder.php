<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
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
                $seen = ['yes' , 'no'];
                $seen = $seen[array_rand($seen)];

                \App\Models\Notification::create([
                    'name'    => $faker->word ,
                    'type'    => $faker->word ,
                    'content' => $faker->sentence(rand(5 , 10)) ,
                    'seen'    => $seen ,
                    'send_to' => [] ,
                ]);
            }
        }
    }

}
