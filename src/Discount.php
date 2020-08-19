<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function variant(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Variant');
    }
}
