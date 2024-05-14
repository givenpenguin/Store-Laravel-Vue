<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SizeProduct;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __invoke(Product $product)
    {
        Storage::disk('public')->delete($product['preview_image']);

        $imagesPath = ProductImage::where('product_id', $product['id'])->get();
        foreach ($imagesPath as $path) {
            Storage::disk('public')->delete($path->file_path);
        }

        ProductImage::where('product_id', $product['id'])->delete();
        SizeProduct::where('product_id', $product['id'])->delete();

        $product->delete();

        return redirect()->route('product.index');
    }
}
