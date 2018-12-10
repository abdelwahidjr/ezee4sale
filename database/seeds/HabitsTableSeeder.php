<?php

use App\Models\Habit;
use Faker\Factory;
use Illuminate\Database\Seeder;

class HabitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        if (app()->environment() !== 'production' && App::runningInConsole())
        {
            foreach (range(1 , 50) as $index)
            {
                $date = new DateTime('today');
                $date->modify('+' . rand(100 , 200) . 'day');
                $date->format('Y-m-d');
                Habit::create([
                    'user_id'     => rand(1 , 50) ,
                    'item_id'     => rand(1 , 50) ,
                    'probability' => rand(1 , 100) / 100 ,
                    'habit_time'  => rand(1 , 24) ,
                    'dayofweek'   => rand(0 , 6) ,
                ]);
            }
        }
    }
}
