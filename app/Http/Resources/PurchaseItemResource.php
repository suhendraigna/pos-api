<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PurchaseResource;
use App\Http\Resources\ProductResource;

class PurchaseItemResource extends JsonResource
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
            'purchase_id' => $this->purchase_id,
            'product_id' => $this->product_id,

            'price' => $this->price,
            'quantity' => $this->quantity,
            'subtotal' => $this->subtotal,

            'formatted_price' => number_format($this->price, 2),
            'formatted_subtotal' => number_format($this->subtotal, 2),

            'purchase' => new PurchaseResource($this->whenLoaded('purchase')),
            'product' => new ProductResource($this->whenLoaded('product')),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
