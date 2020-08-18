<?php

namespace Jskrd\Shop\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Jskrd\Shop\Http\Resources\ImageProduct as ImageProductResource;
use Jskrd\Shop\Http\Resources\ImageVariant as ImageVariantResource;

class Image extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'path' => $this->path,
            'width' => $this->width,
            'height' => $this->height,
            'size' => $this->size,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'image_product' => $this->whenPivotLoaded(
                'image_product',
                function () {
                    return new ImageProductResource($this->pivot);
                }
            ),
            'image_variant' => $this->whenPivotLoaded(
                'image_variant',
                function () {
                    return new ImageVariantResource($this->pivot);
                }
            ),
        ];
    }
}
