<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ErrorException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
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
        return new ProductCollection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
            $productId = DB::table('products')->insertGetId([
                'name'        => $request->name,
                'category_id' => $request->category_id,
                'feature_id'  => $request->feature_id,
                'slug'        => Str::slug($request->name),
                'created_at'  => now()
            ]);
    
            return response([ 
                'message'      =>  'Product success added',
                'created_data' =>  new ProductResource(DB::table('products')->find($productId))
                 ], 201);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = DB::table('products')->find($id);

            return new ProductResource($product);
        } 
        catch(ErrorException $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        DB::table('products')->where('id', $id)->update([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'feature_id'  => $request->feature_id,
            'slug'        => Str::slug($request->name),
            'created_at'  => now()
       ]);

       return response([
           'message'      =>  'Update success update',
           'updated_data' =>  new ProductResource( DB::table('products' )->find($id))
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::table('products')->where('id', $id)->delete();

            return response(['message' => 'Product Deleted'], 200);
        } 
        catch(ErrorException $exception){
            return $exception->getMessage();
        }
    }
}
