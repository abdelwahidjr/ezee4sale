<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Eloquent::unguard();

        $path = 'database/sql/insert_countries.sql';
        DB::unprepared(file_get_contents($path));

        Eloquent::reguard();

    }


}
