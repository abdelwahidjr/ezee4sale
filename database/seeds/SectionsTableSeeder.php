<?php

use App\Models\Section;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
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
                Section::create([
                    'title'       => $faker->word ,
                    'description' => $faker->sentence(rand(10 , 100)) ,
                    'content'     => $faker->sentence(rand(100 , 1000)) ,
                    'page_id'     => rand(1 , 50) ,
                ]);
            }
        }
    }


}
