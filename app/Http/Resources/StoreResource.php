<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ProductResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\PurchaseResource;
use App\Http\Resources\StockLedgerResource;

class StoreResource extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,

            'products' => ProductResource::collection(
                $this->whenLoaded('products')
            ),

            'transactions' => TransactionResource::collection(
                $this->whenLoaded('transactions')
            ),

            'purchases' => PurchaseResource::collection(
                $this->whenLoaded('purchases')
            ),

            'stock_ledgers' => StockLedgerResource::collection(
                $this->whenLoaded('stockLedgers')
            ),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
