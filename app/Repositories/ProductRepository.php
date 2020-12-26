<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductRepository implements ProductInterface 
{
    public function getFilterData($request)
    {
        $qb         = DB::table('products');
        $db_feature = DB::table('features');
        $db_cat     = DB::table('categories');

        if($request->has('search')){
            $qb->where('name', 'like', '%'.$request->query('search').'%' );
        }       
        if($request->has('category')){
            $id = $db_cat->where('slug', $request->query('category'))->value('id');
            $qb->where('category_id', $id);
        }
        if($request->has('model')){
            $model_id = $db_feature->where('model', $request->query('model'))->pluck('id');
            $qb ->whereIn('feature_id', $model_id);
        }
        if($request->has('marka')){
            $marka_id = $db_feature->where('marka', $request->query('marka'))->pluck('id');
            $qb ->whereIn('feature_id', $marka_id);
        }
        if($request->has('size')){
            $size_id = $db_feature->where('size', $request->query('size'))->pluck('id');
            $qb ->whereIn('feature_id', $size_id);
        }
        if($request->has('sortBy')){
            $qb->orderBy($request->query('sortBy'), $request->query('sort', 'DESC'));
        }
        $request->has('paginate') ? $p = $request->query('paginate') : $p = 10;

        $data = $qb->paginate($p);
        
        return $data;
    }

    public function getById($id)
    {
        return DB::table('products')->find($id);
    }

    public function store(array $data)
    {
        $productId = DB::table('products')->insertGetId([
                    'name'        => $data['name'],
                    'category_id' => $data['category_id'],
                    'feature_id'  => $data['feature_id'],
                    'slug'        => Str::slug($data['name']),
                    'created_at'  => now()
                     ]);

        return $productId;
    }

    public function update(array $data, $id)
    {
        $update =  DB::table('products')->where('id', $id)->update([
                   'name'        => $data['name'],
                   'category_id' => $data['category_id'],
                   'feature_id'  => $data['feature_id'],
                   'slug'        => Str::slug($data['name']),
                   'created_at'  => now()
                    ]);
        return $update;
    }

    public function delete($id)
    {
        return DB::table('products')->where('id', $id)->delete();;
    }



}