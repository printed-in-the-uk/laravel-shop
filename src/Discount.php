<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jskrd\Shop\Traits\Identifies;

class Discount extends Model
{
    use Identifies;

    protected $fillable = [
        'name',
        'code',
        'percent',
        'maximum',
        'limit',
    ];

    protected $keyType = 'string';

    public function baskets(): HasMany
    {
        return $this->hasMany('Jskrd\Shop\Basket');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Variant');
    }
}
