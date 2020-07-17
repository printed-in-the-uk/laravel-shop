<?php

namespace Jskrd\Shop\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageVariant extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'image_id' => $this->image_id,
            'variant_id' => $this->variant_id,
            'position' => $this->position,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
