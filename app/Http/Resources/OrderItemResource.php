<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => (float) $this->price,
            'product' => new ProductResource($this->whenLoaded('product')),
            'total_price' => (float) ($this->quantity * $this->price),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
