<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;

class RefundResource extends JsonResource
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
            'transaction_id' => $this->transcation_id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'reason' => $this->reason,

            'formatted_amount' => number_format($this->amount, 2),

            'transaction' => new TransactionResource($this->whenLoaded('transaction')),
            'user' => new UserResource($this->whenLoaded('user')),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
