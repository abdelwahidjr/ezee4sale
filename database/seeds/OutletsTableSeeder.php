<?php

use App\Models\Outlet;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OutletsTableSeeder extends Seeder
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
                $status = ['activated' , 'banned'];
                $status = $status[array_rand($status)];

                $has_delivery = ['yes' , 'no'];
                $has_delivery = $has_delivery[array_rand($has_delivery)];

                Outlet::create([
                    'name'         => $name = $faker->word ,
                    'address'      => $faker->address ,
                    'phone'        => $faker->phoneNumber ,
                    'latitude'     => $faker->latitude ,
                    'longitude'    => $faker->longitude ,
                    'status'       => $status ,
                    'has_delivery' => $has_delivery ,
                    'tax'          => rand(5 , 20) ,
                    'opening'      => rand(10 , 14) . ':' . '00' ,
                    'closing'      => '0' . rand(1 , 4) . ':' . '00' ,
                    'location'     => $faker->city ,
                    'capacity'     => rand(1000 , 10000) ,
                    'city_id'      => rand(1 , 50) ,
                    'brand_id'     => rand(1 , 50) ,
                ]);
            }
        }
    }

}

