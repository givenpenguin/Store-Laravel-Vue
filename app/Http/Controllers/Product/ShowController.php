<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SizeProduct;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        $sizes = SizeProduct::all();
        $categories = Category::all();

        return view('product.show', compact('product', 'sizes', 'categories'));
    }
}
