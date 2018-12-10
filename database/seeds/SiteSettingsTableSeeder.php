<?php

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{
    public function run()
    {
        if (app()->environment() !== 'production' && App::runningInConsole())
        {
            $name  = [
                'commission_annual' ,
                'commission_order_fixed' ,
                'commission_order_percentage' ,
                'kw_tax' ,
            ];
            $type  = [
                'commission' ,
                'commission' ,
                'commission' ,
                'financial' ,
            ];
            $value = [
                '20000' ,
                '100' ,
                '5' ,
                '10.00' ,
            ];

            $count = count($name);

            foreach (range(0 , $count - 1) as $index)
            {
                SiteSetting::create([
                    'name'   => $name[$index] ,
                    'type'   => $type[$index] ,
                    'value'  => $value[$index] ,
                    'switch' => 'on' ,
                ]);
            }
        }
    }

}
