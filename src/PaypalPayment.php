<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;

class PaypalPayment extends Model
{
    protected $fillable = [
        'id'
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function order()
    {
        return $this->morphOne('Jskrd\Shop\Order', 'paymentable');
    }
}
