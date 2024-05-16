<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\Models\SizeProduct;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $sizesId = $data['sizes'];
        $quantities = $data['quantities'];
        unset($data['sizes']);

        $product->update([
            'title' => $data['title'],
            'article' => $data['article'],
            'description' => $data['description'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'category_id' => $data['category_id'],
        ]);

        SizeProduct::where('product_id', $product['id'])->delete();
        foreach ($sizesId as $key => $sizeId) {
            SizeProduct::updateOrCreate([
                'product_id' => $product->id,
                'size_id' => $sizeId,
                'quantity' => $quantities[$key],
            ]);
        }

        return view('product.show', compact('product'));
    }
}
