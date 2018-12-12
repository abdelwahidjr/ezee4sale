<?php

use App\Models\Coupon;
use App\Models\Item;
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
        if (app()->environment() !== 'production' && App::runningInConsole()) {
            foreach (range(1, 50) as $index) {

                Coupon::create([
                    'title' => $faker->name,
                    'price' => rand(1,1000),
                    'code'  => md5(uniqid()),
                    'user_id' => array_random([ null, rand(1, 50)]),
                ]);
            }
        }
    }
}
