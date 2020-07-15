<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Jskrd\Shop\Traits\Identifiable;

class Basket extends Model
{
    use Identifiable;

    public function order(): HasOne
    {
        return $this->hasOne('Jskrd\Shop\Order');
    }

    public function variants(): BelongsToMany
    {
        return $this
            ->belongsToMany('Jskrd\Shop\Variant')
            ->using('Jskrd\Shop\BasketVariant')
            ->withPivot('quantity', 'price', 'delivery_cost')
            ->withTimestamps();
    }
}
