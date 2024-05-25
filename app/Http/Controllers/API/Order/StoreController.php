<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Requests\API\Order\StoreRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Customer;
use App\Models\Order;
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
        ], $data);

        return new OrderResource($order);
    }
}
