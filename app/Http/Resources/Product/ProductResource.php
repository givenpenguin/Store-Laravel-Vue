<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Size\SizeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'sizes' => SizeResource::collection($this->sizes),
            'image_url' => $this->imageUrl,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'quantity' => $this->quantity,
            'category' => new CategoryResource($this->category),
        ];
    }
}
