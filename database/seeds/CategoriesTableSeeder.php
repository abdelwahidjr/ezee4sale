<?php

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                $model = [
                    'App\Models\Brand' ,
                    'App\Models\Outlet' ,
                    'App\Models\Menu' ,
                    'App\Models\Item' ,
                ];

                $model = $model[array_rand($model)];

                Category::create([
                    'name'                => $faker->name ,
                    'description'         => $faker->name ,
                    'image'               => asset('images/placeholder.png') ,
                    'category_morph_type' => $model ,
                    'category_morph_id'   => rand(1 , 50) ,
                ]);
            }
        }

    }

}
