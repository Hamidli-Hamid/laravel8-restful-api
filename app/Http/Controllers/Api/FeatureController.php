<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Http\Resources\FeatureCollection;
use App\Http\Resources\FeatureResource;
use App\Services\FeatureService;

class FeatureController extends Controller
{
    protected $service;

    public function __construct(FeatureService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FeatureCollection($this->service->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureRequest $request)
    {
        $data = $request->all();
        $featureId = $this->service->create($data);

        return response([ 
            'message'      =>  'Feature success added',
            'created_data' =>  new FeatureResource($this->service->getById($featureId))
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
        return new FeatureResource($this->service->getById($id));
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
        $data = $request->all();
        $featureId = $this->service->create($data);

        return response([
           'message'      =>  'Feature success update',
           'updated_data' =>  new FeatureResource($this->service->getById($featureId))
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
        $this->service->delete($id);
        
        return response(['message' => 'Feature Deleted'], 200);
    }
}
