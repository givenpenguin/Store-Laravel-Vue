<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Size\SizeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
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
            'article' => $this->article,
            'sizes' => SizeResource::collection($this->sizes),
            'description' => $this->description,
            'image_url' => $this->imageUrl,
            'product_images' => ProductImageResource::collection($this->productImages),
            'price' => $this->price,
            'discount' => $this->discount,
            'category' => new CategoryResource($this->category),
        ];
    }
}
