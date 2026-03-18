<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\StoreResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TransactionItemResource;
use App\Http\Resources\PurchaseItemResource;
use App\Http\Resources\StockLedgerResource;

class ProductResource extends JsonResource
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
            'sku' => $this->sku,
            'barcode' => $this->barcode,
            'price' => $this->price,
            'cost_price' => $this->cost_price,
            'stock' => $this->stock,
            'is_active' => $this->is_active,

            'store' => new StoreResource($this->whenLoaded('store')),
            'category' => new CategoryResource($this->whenLoaded('category')),

            'transaction_items' => TransactionItemResource::collection(
                $this->whenLoaded('transactionItems')
            ),

            'purchase_items' => PurchaseItemResource::collection(
                $this->whenLoaded('purchaseItems')
            ),

            'stock_ledgers' => StockLedgerResource::collection(
                $this->whenLoaded('stockLedgers')
            ),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
