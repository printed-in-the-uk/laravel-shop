<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jskrd\Shop\Traits\Identifiable;
use Jskrd\Shop\Traits\Slugifiable;

class Variant extends Model
{
    use Identifiable;
    use Slugifiable;

    protected $casts = [
        'price' => 'integer',
        'original_price' => 'integer',
        'delivery_cost' => 'integer',
        'stock' => 'integer',
    ];

    protected $fillable = [
        'name',
        'price',
        'original_price',
        'delivery_cost',
        'sku',
        'stock',
        'option1',
        'option2',
        'option3',
    ];

    public function baskets(): BelongsToMany
    {
        return $this
            ->belongsToMany('Jskrd\Shop\Basket')
            ->using('Jskrd\Shop\BasketVariant')
            ->withPivot('customizations', 'quantity', 'price')
            ->withTimestamps();
    }

    public function discounts(): HasMany
    {
        return $this->hasMany('Jskrd\Shop\Discount');
    }

    public function images(): BelongsToMany
    {
        return $this
            ->belongsToMany('Jskrd\Shop\Image')
            ->using('Jskrd\Shop\ImageProduct')
            ->withPivot('position')
            ->withTimestamps();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Product');
    }

    public function zones(): BelongsToMany
    {
        return $this
            ->belongsToMany('Jskrd\Shop\Zone')
            ->using('Jskrd\Shop\VariantZone')
            ->withPivot('delivery_cost')
            ->withTimestamps();
    }
}
