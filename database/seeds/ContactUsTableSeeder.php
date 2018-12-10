<?php

use App\Models\ContactUs;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ContactUsTableSeeder extends Seeder
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
                ContactUs::create([
                    'site_name'    => $faker->word ,
                    'phone'        => [] ,
                    'address'      => [] ,
                    'social_media' => [] ,
                    'email'        => [] ,
                ]);
            }
        }
    }

}

