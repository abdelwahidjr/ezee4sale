<?php

use App\Models\OutletArea;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OutletAreasTableSeeder extends Seeder
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
                $status = ['on' , 'off'];
                $status = $status[array_rand($status)];

                OutletArea::create([
                    'outlet_id'             => rand(1 , 30) ,
                    'area_id'               => rand(1 , 30) ,
                    'delivery_fee'          => rand(1 , 30) ,
                    'delivery_time'         => '00:20:00' ,
                    'delivery_availability' => $status ,

                ]);
            }
        }
    }

}
