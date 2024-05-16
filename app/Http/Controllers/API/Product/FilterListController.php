<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Size\SizeFilterResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;

class FilterListController extends Controller
{
    public function __invoke()
    {
        $categories = CategoryResource::collection(Category::all());
        $sizes = SizeFilterResource::collection(Size::all());

        $maxPrice = Product::max('price');
        $minPrice = Product::min('price');

        return [
            'categories' => $categories,
            'sizes' => $sizes,
            'price' => [
                    'max' => $maxPrice,
                    'min' => $minPrice,
                ],
        ];
    }
}
