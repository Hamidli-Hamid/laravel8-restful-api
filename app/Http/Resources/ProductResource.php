<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'product_name' => $this->name,
            'category_data'=> new CategoryResource( DB::table('categories')->where('id', $this->category_id)->first() ),
            'feature_data' => new FeatureResource( DB::table('features')->where('id', $this->feature_id)->first() ),
            'slug'         => $this->slug,
            'status'       => $this->status,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'product_link' => [
                                'link' => route('products.show', $this->id)
                              ]
        ];
    }
}
