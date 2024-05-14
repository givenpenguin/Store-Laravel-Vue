<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;

class EditImageController extends Controller
{
    public function __invoke(Product $product)
    {
        $images = ProductImage::where('product_id', $product['id'])->get();

        return view('product.edit-image', compact('product', 'images'));
    }
}
