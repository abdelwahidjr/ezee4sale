<?php

use App\Banner;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        if (app()->environment() !== 'production' && App::runningInConsole()) {
            foreach (range(1, 50) as $index) {
                $type = ['ad', 'market'];
                $type = $type[array_rand($type)];


               Banner::create([
                    'phone'          => $faker->phoneNumber,
                    'whats_app'      => $faker->phoneNumber,
                    'email'          => $faker->email,
                    'image_url'      => asset('images/placeholder.png') ,
                    'categories'     => [],
                    'appear_on_home' => $faker->boolean,
                    'type' => $type ,
                ]);
            }
        }
    }
}
