<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;

class EditController
{
    public function __invoke(Order $order)
    {
        return view('order.edit', compact('order'));
    }
}
