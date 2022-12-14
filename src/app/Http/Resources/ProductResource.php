<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'is_active' => $this->is_active,
            'name' => $this->name,
            'description' => htmlspecialchars_decode($this->description),
            'description_short' => strip_tags(htmlspecialchars_decode($this->description)),
            'category' => new ProductCategoryResource($this->category),
            'price' => $this->price,
            'stock' => $this->stock,
            'identifier' => $this->identifier,
        ];
    }
}
