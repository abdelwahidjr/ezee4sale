<?php

use App\Models\Popup;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PopupsTableSeeder extends Seeder
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
                $status = ['activated' , 'deactivated'];
                $status = $status[array_rand($status)];

                Popup::create([
                    'title'   => $faker->word ,
                    'content' => $faker->sentence(rand(5 , 10)) ,
                    'status'  => $status ,
                    'ad_id'   => rand(1 , 50) ,
                ]);
            }
        }
    }

}
