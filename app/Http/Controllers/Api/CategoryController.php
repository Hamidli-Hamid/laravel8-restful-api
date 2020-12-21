<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;                           
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CategoryCollection(DB::table('categories')->orderBy('created_at', 'DESC')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
         $categoryId = DB::table('categories')->insertGetId([
            'title' => $request->category_title,
            'slug'  => Str::slug($request->category_title),
            'created_at' => now()
        ]);

        return response([ 
            'message'      =>  'Category success added',
            'created_data' =>  new CategoryResource(DB::table('categories')->find($categoryId))
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
        $category = DB::table('categories')->find($id);

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
       DB::table('categories')->where('id', $id)->update([
            'title' => $request->category_title,
            'slug'  => Str::slug($request->category_title),
            'updated_at' => now()
       ]);

       return response([
           'message'      =>  'Category success update',
           'updated_data' =>  new CategoryResource( DB::table('categories' )->find($id))
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
        DB::table('categories')->where('id', $id)->delete();

        return response(['message' => 'Category Deleted'], 200);
    }
}
