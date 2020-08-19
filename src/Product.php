<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jskrd\Shop\Traits\Identifies;
use Jskrd\Shop\Traits\Slugifiable;

class Product extends Model
{
    use Identifies;
    use Slugifiable;

    protected $fillable = [
        'name',
        'options1',
        'options2',
        'options3',
    ];

    public function images(): BelongsToMany
    {
        return $this
            ->belongsToMany('Jskrd\Shop\Image')
            ->using('Jskrd\Shop\ImageProduct')
            ->withPivot('position')
            ->withTimestamps();
    }

    public function variants(): HasMany
    {
        return $this->hasMany('Jskrd\Shop\Variant');
    }
}
