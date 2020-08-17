<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Jskrd\Shop\Traits\Identifiable;

class Basket extends Model
{
    use Identifiable;

    protected $casts = [
        'variants_count' => 'integer',
        'delivery_cost' => 'integer',
    ];

    protected $fillable = [
        'delivery_cost',
    ];

    protected $withCount = ['variants'];

    public function billingAddress(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Address');
    }

    public function deliveryAddress(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Address');
    }

    public function getSubtotalAttribute(): int
    {
        $subtotal = 0;

        foreach ($this->variants as $variant) {
            $subtotal += $variant->pivot->price * $variant->pivot->quantity;
        }

        return $subtotal;
    }

    public function order(): HasOne
    {
        return $this->hasOne('Jskrd\Shop\Order');
    }

    public function variants(): BelongsToMany
    {
        return $this
            ->belongsToMany('Jskrd\Shop\Variant')
            ->using('Jskrd\Shop\BasketVariant')
            ->withPivot('customizations', 'quantity', 'price')
            ->withTimestamps();
    }
}
