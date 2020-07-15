<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ImageVariant extends Pivot
{
    protected $casts = [
        'position' => 'integer',
    ];
}
