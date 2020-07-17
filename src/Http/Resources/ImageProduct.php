<?php

namespace Jskrd\Shop\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageProduct extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'image_id' => $this->image_id,
            'product_id' => $this->product_id,
            'position' => $this->position,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
