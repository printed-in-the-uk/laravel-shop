<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BasketVariant extends Pivot
{
    protected $casts = [
        'customizations' => 'array',
        'quantity' => 'integer',
        'price' => 'integer',
        'delivery_cost' => 'integer',
    ];
}
