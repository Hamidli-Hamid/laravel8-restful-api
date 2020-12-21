<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['title'=>'Kişi','slug'=>'kisi','status'=>1]);
        DB::table('categories')->insert(['title'=>'Qadın','slug'=>'qadin','status'=>1]);
        DB::table('categories')->insert(['title'=>'Unisex','slug'=>'unisex','status'=>1]);
        DB::table('categories')->insert(['title'=>'Xüsusi','slug'=>'xususi','status'=>1]);
    }
}
