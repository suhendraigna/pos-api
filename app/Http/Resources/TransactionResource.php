<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\StoreResource;
use App\Http\Resources\CashSessionResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\TransactionItemResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\RefundResource;

class TransactionResource extends JsonResource
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
            'store_id' => $this->store_id,
            'cash_session_id' => $this->cash_session_id,
            'user_id' => $this->user_id,

            'invoice_number' => $this->invoice_number,

            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'total' => $this->total,

            'status' => $this->status,
            'paid_at' => $this->paid_at?->toDateTimeString(),

            'is_paid' => !is_null($this->paid_at),

            'store' => new StoreResource(
                $this->whenLoaded('store')
            ),

            'cash_session' => new CashSessionResource(
                $this->whenLoaded('cashSession')
            ),

            'user' => new UserResource(
                $this->whenLoaded('user')
            ),

            'items' => TransactionItemResource::collection(
                $this->whenLoaded('items')
            ),

            'payments' => PaymentResource::collection(
                $this->whenLoaded('payments')
            ),

            'refunds' => RefundResource::collection(
                $this->whenLoaded('refunds')
            ),

            'items_count' => $this->whenCounted('items'),
            'payments_count' => $this->whenCounted('payments'),
            'refunds_count' => $this->whenCounted('refunds'),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
