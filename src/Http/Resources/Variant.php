<?php

namespace Jskrd\Shop\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Jskrd\Shop\Http\Resources\BasketVariant as BasketVariantResource;

class Variant extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'original_price' => $this->original_price,
            'delivery_cost' => $this->delivery_cost,
            'sku' => $this->sku,
            'stock' => $this->stock,
            'option1' => $this->option1,
            'option2' => $this->option2,
            'option3' => $this->option3,
            'product_id' => $this->product_id,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
            'basket_variant' => $this->whenPivotLoaded(
                'basket_variant',
                function () {
                    return new BasketVariantResource($this->pivot);
                }
            ),
        ];
    }
}
