<?php

namespace Jskrd\Shop\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
