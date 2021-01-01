<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductRepository implements ProductInterface 
{

    protected $db_category,  $db_product, $db_feature;

    public function __construct()
    {
        $this->db_category = DB::table('categories');
        $this->db_product  = DB::table('products');
        $this->db_feature  = DB::table('features');
    }

    public function getFilterData($request)
    {
        $qb = $this->db_product;

        if($request->has('search')){
            $qb->where('name', 'like', '%'.$request->query('search').'%' );
        }       
        if($request->has('category')){
            $id = $this->db_category->where('title', $request->query('category'))->value('id');
            $qb->where('category_id', $id);
        }
        if($request->has('model')){
            $model_id = $this->db_feature->where('model', $request->query('model'))->pluck('id');
            $qb ->whereIn('feature_id', $model_id);
        }
        if($request->has('marka')){
            $marka_id = $this->db_feature->where('marka', $request->query('marka'))->pluck('id');
            $qb ->whereIn('feature_id', $marka_id);
        }
        if($request->has('size')){
            $size_id = $this->db_feature->where('size', $request->query('size'))->pluck('id');
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
        return $this->db_product->find($id);
    }

    public function create(array $data)
    {
        $productId = $this->db_product->insertGetId([
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
        $update =  $this->db_product->where('id', $id)->update([
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
        return $this->db_product->where('id', $id)->delete();
    }



}