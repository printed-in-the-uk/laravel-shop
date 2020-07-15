<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Relations\Pivot;

class VariantZone extends Pivot
{
    protected $casts = [
        'delivery_cost' => 'integer',
    ];
}
