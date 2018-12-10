<?php

use App\Models\Page;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
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
                $status = ['activated' , 'deactivated'];
                $status = $status[array_rand($status)];

                Page::create([
                    'title'       => $faker->word ,
                    'content'     => $faker->sentence(rand(100 , 1000)) ,
                    'description' => $faker->sentence(rand(10 , 100)) ,
                    'status'      => $status ,
                ]);
            }
        }
    }

}
