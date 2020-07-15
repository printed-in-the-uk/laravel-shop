<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Jskrd\Shop\Traits\Identifiable;

class Transaction extends Model
{
    use Identifiable;

    protected $fillable = [
        'amount',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo('Jskrd\Shop\Order');
    }

    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }
}
