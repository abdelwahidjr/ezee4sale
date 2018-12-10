<?php

use App\Models\SubOrder;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SubOrdersTableSeeder extends Seeder
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

                $tax          = number_format(rand(10 , 20) , 2 , "." , "");
                $rand_decimal = number_format(rand(10 , 1000) , 2 , "." , "");

                $status = ['pending' , 'confirmed'];
                $status = $status[array_rand($status)];

                $delivery_states = ['delivered' , 'out_for_delivery' , 'not_delivered'];
                $delivery_states = $delivery_states[array_rand($delivery_states)];

                $price       = $rand_decimal;
                $tax_rate    = $tax;
                $tax_val     = $price * $tax_rate / 100;
                $total_price = (double) $price + $tax_val;

                $today     = new DateTime();
                $timestamp = $today->format('His');

                SubOrder::create([
                    'number'                 => $timestamp . '-' . rand(10 , 1000) ,
                    'item'                   => [] ,
                    'status'                 => $status ,
                    'delivery'               => $delivery_states ,
                    'total_qty'              => rand(1 , 50) ,
                    'total_price_before_tax' => $price ,
                    'tax_val'                => $tax_val ,
                    'total_price_after_tax'  => $total_price ,
                    'order_id'               => rand(1 , 50) ,
                    'outlet_id'               => rand(1 , 50) ,
                ]);
            }
        }
    }

}

