<?php

namespace Jskrd\Shop\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BasketVariant extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'basket_id' => $this->basket_id,
            'variant_id' => $this->variant_id,
            'customizations' => $this->customizations,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
