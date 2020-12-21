<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(['name'=>'Tiziana Terenzi Andromeda', 'category_id'=>1, 'feature_id'=>1, 'slug'=>'tiziana-terenzi-andromeda','status'=>1, 'created_at'=>now()]);
        DB::table('products')->insert(['name'=>'Victorias Secret Bombshell', 'category_id'=>2, 'feature_id'=>2, 'slug'=>'victorias-secret-bombshell','status'=>1, 'created_at'=>now()]);
        DB::table('products')->insert(['name'=>'Tiffany & Co Sheer', 'category_id'=>3, 'feature_id'=>3, 'slug'=>'tiffany-co-sheer','status'=>1, 'created_at'=>now()]);
        DB::table('products')->insert(['name'=>'Armani Prive Ombre & Lumiere', 'category_id'=>4, 'feature_id'=>4, 'slug'=>'armani-prive-ombre-lumiere','status'=>1, 'created_at'=>now()]);
                
    }
}
