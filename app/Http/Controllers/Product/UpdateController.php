<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SizeProduct;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

        $sizesId = $data['sizes'];
        $productImages = $data['product_images'];
        unset($data['sizes'], $data['product_images']);

        $product = Product::updateOrCreate([
            'article' => $data['article']
        ], $data);

        foreach ($sizesId as $sizeId) {
            SizeProduct::updateOrCreate([
                'product_id' => $product->id,
                'size_id' => $sizeId,
            ]);
        }

        foreach ($productImages as $productImage) {
            $filePath = Storage::disk('public')->put('/images', $productImage);
            ProductImage::updateOrCreate([
                'product_id' => $product->id,
                'file_path' => $filePath,
            ]);
        }

        return view('product.show', compact('product'));
    }
}
