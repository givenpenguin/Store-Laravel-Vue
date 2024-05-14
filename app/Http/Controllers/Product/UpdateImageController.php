<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class UpdateImageController extends Controller
{
    public function __invoke(UpdateImageRequest $request, Product $product)
    {
        $data = $request->validated();

        if(isset($data['preview_image'])) {
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $product->update(['preview_image' => $data['preview_image']]);
        }

        if(isset($data['product_images'])) {
            $productImages = $data['product_images'];
            foreach ($productImages as $productImage) {
                $filePath = Storage::disk('public')->put('/images', $productImage);
                ProductImage::updateOrCreate([
                    'product_id' => $product->id,
                    'file_path' => $filePath,
                ]);
            }
        }

        if(isset($data['deleted_images'])) {
            $deletedImages = $data['deleted_images'];
            foreach ($deletedImages as $path) {
                Storage::disk('public')->delete($path);
                ProductImage::where('product_id', $product['id'])->where('file_path', $path)->delete();
            }
        }

        return view('product.show', compact('product'));
    }
}
