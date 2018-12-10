<?php

use App\Models\Ad;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AdsTableSeeder extends Seeder
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

                $position = ['top' , 'bottom' , 'between' , 'anywhere'];
                $position = $position[array_rand($position)];

                Ad::create([
                    'title'     => $faker->word ,
                    'content'   => $faker->sentence(rand(5 , 10)) ,
                    'video_url' => 'https://youtu.be/Bey4XXJAqS8' ,
                    'image'     => asset('images/placeholder.png') ,
                    'status'    => $status ,
                    'position'  => $position ,
                ]);
            }
        }
    }

}
