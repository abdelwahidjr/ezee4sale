<?php

use App\Models\Event;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
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

                $start = new DateTime('today');
                $end   = $start->modify('+' . rand(100 , 200) . 'day');
                $end->format('Y-m-d');

                Event::create([
                    'name'        => $faker->word ,
                    'description' => $faker->sentence(rand(10 , 20)) ,
                    'start'       => $start ,
                    'end'         => $end ,
                ]);
            }
        }
    }


}
