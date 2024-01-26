<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Resources\Product\ProductResource;
use Illuminate\Routing\Controller;
use App\Models\Product;

class IndexController extends Controller
{
    public function __invoke()
    {
        return ProductResource::collection(Product::all());
    }
}
