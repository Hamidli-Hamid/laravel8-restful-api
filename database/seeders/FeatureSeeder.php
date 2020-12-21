<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('features')->insert(['marka'=>'Tiziana',   'model'=>'Tiziana',  'size'=>'30']);
        DB::table('features')->insert(['marka'=>'Victorias', 'model'=>'Victorias','size'=>'50']);
        DB::table('features')->insert(['marka'=>'Tiffany',   'model'=>'Tiffany',  'size'=>'50']);
        DB::table('features')->insert(['marka'=>'Armani',    'model'=>'Armani',   'size'=>'100']);
   
    }
}
