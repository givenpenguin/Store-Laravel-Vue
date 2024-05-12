<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Resources\Product\ProductDetailsResource;
use Illuminate\Routing\Controller;
use App\Models\Product;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        return new ProductDetailsResource($product);
    }
}
