<?php

namespace Jskrd\Shop\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'options1' => $this->options1,
            'options2' => $this->options2,
            'options3' => $this->options3,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
