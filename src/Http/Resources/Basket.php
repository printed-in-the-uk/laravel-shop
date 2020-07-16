<?php

namespace Jskrd\Shop\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Basket extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'variants_count' => $this->variants_count ?? 0,
            'subtotal' => $this->subtotal,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
