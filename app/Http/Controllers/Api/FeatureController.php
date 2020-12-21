<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Http\Resources\FeatureCollection;
use App\Http\Resources\FeatureResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FeatureCollection(DB::table('features')->orderBy('created_at', 'DESC')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureRequest $request)
    {
        $featureId = DB::table('features')->insertGetId([
            'marka'      => $request->product_marka,
            'model'      => $request->product_model,
            'size'       => $request->product_size
        ]);

        return response([ 
            'message'      =>  'Feature success added',
            'created_data' =>  new FeatureResource(DB::table('features')->find($featureId))
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
        $feature = DB::table('features')->find($id);

        return new FeatureResource($feature);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeatureRequest $request, $id)
    {
        DB::table('features')->where('id', $id)->update([
            'marka'      => $request->product_marka,
            'model'      => $request->product_model,
            'size'       => $request->product_size
        ]);

       return response([
           'message'      =>  'Feature success update',
           'updated_data' =>  new FeatureResource( DB::table('features' )->find($id))
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
        DB::table('features')->where('id', $id)->delete();

        return response(['message' => 'Feature Deleted'], 200);
    }
}
