<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCategory(){
        return DB::table('categories')
                 ->join('products', 'categories.id', '=', 'products.category.id')
                 ->select('categories')
                 ->get();

       
    }

    public function getFeature(){
        return DB::table('features')
                 ->join('products', 'features.id', '=', 'products.feature_id')
                 ->select('features.*')
                 ->get();                
    }

}
