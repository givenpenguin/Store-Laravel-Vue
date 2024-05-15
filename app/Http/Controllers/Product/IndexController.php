<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;

class IndexController extends Controller
{
    public function __invoke()
    {
        $sizes = Size::all();
        $categories = Category::all();

        $products = Product::all();

        return view('product.index', compact('products', 'sizes', 'categories'));
    }
}
