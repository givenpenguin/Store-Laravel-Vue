<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Size;

class CreateController extends Controller
{
    public function __invoke()
    {
        $sizes = Size::all();
        $categories = Category::all();

        return view('product.create', compact('sizes', 'categories'));
    }
}
