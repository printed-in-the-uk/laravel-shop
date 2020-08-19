<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jskrd\Shop\Traits\Identifies;

class Zone extends Model
{
    use Identifies;

    protected $fillable = [
        'name',
    ];

    public function countries(): HasMany
    {
        return $this->hasMany('Jskrd\Shop\Country');
    }

    public function variants(): BelongsToMany
    {
        return $this
            ->belongsToMany('Jskrd\Shop\Variant')
            ->using('Jskrd\Shop\VariantZone')
            ->withPivot('delivery_cost')
            ->withTimestamps();
    }
}
