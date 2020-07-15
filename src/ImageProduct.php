<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ImageProduct extends Pivot
{
    protected $casts = [
        'position' => 'integer',
    ];
}
