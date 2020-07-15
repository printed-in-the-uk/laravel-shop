<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jskrd\Shop\Traits\Identifiable;

class Country extends Model
{
    use Identifiable;

    protected $fillable = [
        'alpha2',
    ];

    public function zone(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Zone');
    }
}
