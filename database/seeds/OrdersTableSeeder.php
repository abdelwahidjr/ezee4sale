<?php

use App\Models\Order;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
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

                $paymentOption = ['knet', 'cc', 'cash'];
                $paymentOption = $paymentOption[array_rand($paymentOption)];

                $delivery_states = ['delivered' , 'partially_delivered' , 'not_delivered'];
                $delivery_states = $delivery_states[array_rand($delivery_states)];

                $price       = $rand_decimal;
                $tax_rate    = $tax;
                $tax_val     = $price * $tax_rate / 100;
                $total_price = (double) $price + $tax_val;

                $today     = new DateTime();
                $timestamp = $today->format('His');

                Order::create([
                    'number'                 => $timestamp . '-' . rand(10 , 1000) ,
                    'status'                 => $status ,
                    'delivery'               => $delivery_states ,
                    'total_qty'              => rand(1 , 50) ,
                    'total_price_before_tax' => $price ,
                    'tax_val'                => $tax_val ,
                    'total_price_after_tax'  => $total_price ,
                    'notes'                  => $faker->sentence($nbWords = 5) ,
                    'coupon_code'            => $faker->word ,
                    'user_free_credit'       => rand(5 , 20) ,
                    'user_id'                => rand(1 , 50) ,
                    'cart_id'                => rand(1 , 50) ,
                    'gift_card_id'           => rand(1 , 50) ,
                    'payment_option'         => $paymentOption ,
                    'address'                => $faker->word
                ]);
            }
        }
    }

}

