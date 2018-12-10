<?php

use App\Models\Friendship;
use Illuminate\Database\Seeder;

class FriendshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (app()->environment() !== 'production' && App::runningInConsole())
        {
            foreach (range(1 , 50) as $index)
            {
                $status = ['pending' , 'accepted' , 'declined'];
                $status = $status[array_rand($status)];

                Friendship::create([
                    'status'      => $status ,
                    'sender_id'   => rand(1 , 50) ,
                    'receiver_id' => rand(1 , 50) ,
                ]);
            }
        }
    }

}
