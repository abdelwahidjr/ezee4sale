<?php

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->CustomSeeding();

        $faker = Factory::create();

        if (app()->environment() !== 'production' && App::runningInConsole())
        {
            foreach (range(1 , 50) as $index)
            {

                User::create([
                    'name'              => $faker->name ,
                    'email'             => $faker->email ,
                    'password'          => Hash::make('secret') ,
                    'phone'             => $faker->phoneNumber ,
                ]);
            }
        }
    }

    public function CustomSeeding()
    {
        $faker = Factory::create();

        $int  = rand(1262055681 , 1262055681);
        $date = date("Y-m-d" , $int);

        User::create([
            'name'              => 'Admin' ,
            'email'             => 'admin@ecovve.com' ,
            'password'          => Hash::make('secret') ,
            'phone'             => $faker->phoneNumber ,
            'avatar'            => asset('images/placeholder.png') ,
            'area'              => $faker->word ,
            'address'           => [] ,
            'gender'            => 'male' ,
            'birthday'          => $date ,
            'free_credit'       => rand(10 , 1000) ,
            'social_media'      => [] ,
            'verification_code' => $faker->word ,
            'city_id'           => rand(1 , 50) ,
        ]);
    }

}
