<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Routing\Controller;
use App\Models\Product;

class IndexController extends Controller
{
    public function __invoke()
    {
        $products = Product::paginate(1);
        return ProductResource::collection($products);
    }
}
