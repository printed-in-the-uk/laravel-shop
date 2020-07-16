<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Jskrd\Shop\Traits\Identifiable;
use Jskrd\Shop\Traits\Slugifiable;

class Variant extends Model
{
    use Identifiable;
    use Slugifiable;

    protected $fillable = [
        'name',
        'price',
        'delivery_cost',
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
            ->withPivot('customizations', 'quantity', 'price', 'delivery_cost')
            ->withTimestamps();
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
