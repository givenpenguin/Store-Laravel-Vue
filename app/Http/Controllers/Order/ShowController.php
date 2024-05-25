<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;

class ShowController extends Controller
{
    public function __invoke(Order $order)
    {
        $order->products = json_decode($order->products, true);

        return view('order.show', compact('order'));
    }
}
