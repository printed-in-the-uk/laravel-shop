<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Jskrd\Shop\Traits\Identifies;

class Basket extends Model
{
    use Identifies;

    protected $casts = [
        'discount_amount' => 'integer',
        'delivery_cost' => 'integer',
    ];

    protected $fillable = [
        'discount_amount',
        'delivery_cost',
    ];

    public function billingAddress(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Address');
    }

    public function deliveryAddress(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Address');
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Discount');
    }

    public function getSubtotalAttribute(): int
    {
        $subtotal = 0;

        foreach ($this->variants as $variant) {
            $subtotal += $variant->pivot->price * $variant->pivot->quantity;
        }

        return $subtotal;
    }

    public function getTotalAttribute(): int
    {
        $total = $this->subtotal;

        if ($this->discount_amount !== null) {
            $total -= $this->discount_amount;
        }

        if ($this->delivery_cost !== null) {
            $total += $this->delivery_cost;
        }

        return $total;
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
