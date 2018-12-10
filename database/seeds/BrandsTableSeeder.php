<?php

use App\Models\Brand;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
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

                Brand::create([
                    'name'                        => $name = $faker->word ,
                    'description'                 => $faker->sentence(rand(5 , 10)) ,
                    'business_type'               => $faker->word ,
                    'commission_annual'           => '20000' ,
                    'commission_order_fixed'      => '100' ,
                    'commission_order_percentage' => '5' ,
                    'logo'                        => asset('images/placeholder.png') ,
                    'phone'                       => $faker->phoneNumber ,
                    'address'                     => $faker->address ,
                    'has_delivery'                => $has_delivery ,
                    'appears_in_search'           => $has_delivery ,
                    'minimum_charge'              => rand(100 , 500) ,
                    'website'                     => 'www.' . $name . '.com' ,
                    'extra_information'           => $faker->sentence(rand(5 , 10)) ,
                    'status'                      => $status ,
                    'city_id'                     => rand(1 , 50) ,
                    'brand_owner_id'              => rand(1 , 50) ,
                ]);
            }
        }
    }

}

