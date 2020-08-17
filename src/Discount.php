<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jskrd\Shop\Traits\Identifiable;

class Discount extends Model
{
    use Identifiable;

    protected $fillable = [
        'name',
        'code',
        'percent',
        'maximum',
        'limit',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Variant');
    }
}
