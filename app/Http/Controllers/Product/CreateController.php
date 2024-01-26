<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Models\Category;

class CreateController extends Controller
{
    public function __invoke()
    {
        $sizes = Size::all();
        $categories = Category::all();

        return view('product.create', compact('sizes', 'categories'));
    }
}
