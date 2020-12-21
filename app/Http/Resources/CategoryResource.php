<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'                  => $this->id,
            'category_title'      => $this->title,
            'category_slug'       => $this->slug,
            'category_status'     => $this->status,
            'category_created_at' => $this->created_at,
            'category_updated_at' => $this->updated_at,
            'category_link'       => [
                                       'link' => route( 'categories.show', $this->id )
                                     ],
        ];
    }
}


