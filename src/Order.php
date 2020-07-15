<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jskrd\Shop\Traits\Identifiable;

class Order extends Model
{
    use Identifiable;

    public function basket(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Basket');
    }

    public function billingAddress(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Address');
    }

    public function deliveryAddress(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Address');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany('Jskrd\Shop\Transaction');
    }
}
