<?php

use App\Models\Coupon;
use App\Models\Item;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Settings::create([]);
    }
}
