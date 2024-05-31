<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\SizeProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckOrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Order $order,
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->order->order_status === 'Создан' && $this->order->created_at->addDay()->isPast()) {
            $products = json_decode($this->order->products);

            foreach ($products as $product) {
                $sizeProduct = SizeProduct::where('product_id', $product->id)
                    ->where('size_id', $product->sizeId)
                    ->first();
                $sizeProduct?->update(['quantity' => $sizeProduct->quantity + $product->quantity]);
            }
            $this->order->update(['order_status' => 'Отменен']);
        }
    }
}
