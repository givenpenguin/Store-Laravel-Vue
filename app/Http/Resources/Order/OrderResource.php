<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'products' => json_decode($this->products),
            'comment' => $this->comment,
            'delivery_method' => $this->delivery_method,
            'payment_method' => $this->payment_method,
            'amount_of_products' => $this->amount_of_products,
            'amount_of_delivery' => $this->amount_of_delivery,
            'amount_of_discount' => $this->amount_of_discount,
            'total_price' => $this->total_price,
            'order_status' => $this->order_status,
            'track_number' => $this->track_number,
        ];
    }
}
