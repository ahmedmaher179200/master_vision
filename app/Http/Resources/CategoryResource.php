<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'  => $this->name,
            'parent_id'      => $this->parent_id,
            'products'  => $this->Products,
            'child_categories'  => CategoryResource::collection($this->SubCategories),
        ];
    }
}
