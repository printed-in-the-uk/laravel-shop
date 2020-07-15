<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Jskrd\Shop\Traits\Identifiable;

class Image extends Model
{
    use Identifiable;

    protected $fillable = [
        'path',
        'width',
        'height',
        'size',
    ];

    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany('Jskrd\Shop\Product')
            ->using('Jskrd\Shop\ImageProduct')
            ->withPivot('position')
            ->withTimestamps();
    }

    public function variants(): BelongsToMany
    {
        return $this
            ->belongsToMany('Jskrd\Shop\Variant')
            ->using('Jskrd\Shop\ImageVariant')
            ->withPivot('position')
            ->withTimestamps();
    }
}
