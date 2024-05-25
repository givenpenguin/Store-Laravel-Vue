<?php

namespace App\Http\Controllers\Order;

use App\Http\Requests\Order\UpdateRequest;
use App\Models\Order;

class UpdateController
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        $order->update($data);
        $order->products = json_decode($order->products, true);

        return view('order.show', compact('order'));
    }
}
