<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Requests\API\Order\StoreRequest;
use App\Http\Resources\Order\OrderResource;
use App\Jobs\CheckOrderStatus;
use App\Models\Customer;
use App\Models\Order;
use App\Models\SizeProduct;
use Illuminate\Routing\Controller;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $customer = Customer::firstOrCreate([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'city' => $data['city'],
            'street' => $data['street'],
            'building' => $data['building'],
            'flat' => $data['flat'],
            'postal_code' => $data['postal_code'],
        ]);

        $order = Order::create([
            'customer_id' => $customer->id,
            'products' => json_encode($data['products']),
            'comment' => $data['comment'],
            'delivery_method' => $data['delivery_method'],
            'payment_method' => $data['payment_method'],
            'amount_of_products' => $data['amount_of_products'],
            'amount_of_delivery' => $data['amount_of_delivery'],
            'amount_of_discount' => $data['amount_of_discount'],
            'total_price' => $data['total_price'],
            'order_status' => 'Создан',
        ]);

        foreach ($data['products'] as $product) {
            $sizeProduct = SizeProduct::where('product_id', $product['id'])
                ->where('size_id', $product['sizeId'])
                ->first();

            if (isset($sizeProduct) && $sizeProduct->quantity > 0) {
                $sizeProduct->update(['quantity' => $sizeProduct->quantity - $product['quantity']]);
                CheckOrderStatus::dispatch($order)->delay(now()->addDay());

                return response()->json([
                    'route' => 'order-success',
                    'status' => 200,
                    'order' => $data['products'],
                ]);
            } else {
                return response()->json([
                    'route' => 'order-error',
                    'status' => 404,
                    'order' => $order,
                ]);
            }
        }

        return new OrderResource($order);
    }
}
