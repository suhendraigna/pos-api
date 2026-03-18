<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\StoreResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\TransactionResource;

class CashSessionResource extends JsonResource
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
            'user_id' => $this->user_id,

            'opened_at' => $this->opened_at?->toDateTimeString(),
            'closed_at' => $this->closed_at?->toDateTimeString(),

            'opening_balance' => $this->opening_balance,
            'closing_balance' => $thisn->closing_balance,

            'status' => $this->status,

            'is_open' => $this->isOpen(),
            'is_closed' => $this->isClose(),

            'store' => new StoreResource($this->whenLoaded('store')),
            'user' => new UserResource($this->whenLoaded('user')),

            'transactions' => TransactionResource::collection(
                $this->whenLoaded('transactions')
            ),

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
