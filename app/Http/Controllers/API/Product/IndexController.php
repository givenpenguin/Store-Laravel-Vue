<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\API\Product\IndexRequest;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Routing\Controller;
use App\Models\Product;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = Product::filter($filter)->paginate(10);
        return ProductResource::collection($products);
    }
}
