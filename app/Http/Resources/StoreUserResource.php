<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\StoreResource;
use App\Http\Resources\UserResource;

class StoreUserResource extends JsonResource
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
            'role' => $this->role,

            'store' => new StoreResource($this->whenLoaded('store')),
            'user' => new StoreResource($this->whenLoaded('user')),

            'created_at' => $this->created-at?->toDateTimeString(),
            'updated_at' => $this->updated-at?->toDateTimeString(),
        ];
    }
}
