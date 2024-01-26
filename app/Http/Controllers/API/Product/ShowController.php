<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Resources\Product\ShowResource;
use Illuminate\Routing\Controller;
use App\Models\Product;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        return new ShowResource($product);
    }
}
