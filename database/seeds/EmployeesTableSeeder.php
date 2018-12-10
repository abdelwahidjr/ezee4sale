<?php

use App\Http\Controllers\OutletOwnerController;
use App\Models\Employee;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
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

                Employee::create([
                    'job'       => array_random(array(OutletOwnerController::$OUTLET_OWNER_JOB_TITLE , $faker->jobTitle )) ,
                    'user_id'   => rand(1 , 50) ,
                    'outlet_id' => rand(1 , 50) ,
                    'state'     => 'active' ,
                ]);
            }
        }
    }

    public function CustomSeeding()
    {
        Employee::create([
            'job'       => "System Admin" ,
            'user_id'   => '1' ,
            'outlet_id' => '1' ,
            'state'     => 'active' ,
        ]);

    }
}
