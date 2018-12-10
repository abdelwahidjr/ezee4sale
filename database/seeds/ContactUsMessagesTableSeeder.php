<?php

use App\Models\ContactUsMessage;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ContactUsMessagesTableSeeder extends Seeder
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
                ContactUsMessage::create([
                    'name'    => $faker->name ,
                    'email'   => $faker->email ,
                    'phone'   => $faker->phoneNumber ,
                    'message' => $faker->sentence(rand(5 , 10)) ,
                ]);
            }
        }
    }

}


