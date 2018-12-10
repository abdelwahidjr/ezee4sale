<?php

use App\Models\UserSetting;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSettingsTableSeeder extends Seeder
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

                UserSetting::create([
                    'notification' => 'on' ,
                    'report_type'  => 'pdf' ,
                    'language'     => 'en' ,
                    'user_id'      => rand(1 , 50) ,
                ]);
            }
        }
    }

    public function CustomSeeding()
    {
        UserSetting::create([
            'notification' => 'on' ,
            'report_type'  => 'pdf' ,
            'language'     => 'en' ,
            'user_id'      => '1' ,
        ]);

    }
}
