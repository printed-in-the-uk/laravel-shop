<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    protected $fillable = [
        'id',
        'name',
        'percent',
        'maximum',
        'limit',
    ];

    public $incrementing = false;

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
