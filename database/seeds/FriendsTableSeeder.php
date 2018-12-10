<?php

use Illuminate\Database\Seeder;

class FriendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (app()->environment() !== 'production' && App::runningInConsole())
        {
            foreach (range(1 , 200) as $index)
            {
                \App\Models\Friend::create([
                    'user_id'     => rand(1 , 50) ,
                    'friend_id'     => rand(1 , 50) ,
                ]);
            }
        }
    }
}
