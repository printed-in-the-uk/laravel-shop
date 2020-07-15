<?php

namespace Jskrd\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Jskrd\Shop\Traits\Identifiable;

class Address extends Model
{
    use Identifiable;

    protected $fillable = [
        'name',
        'street1',
        'street2',
        'locality',
        'region',
        'postal_code',
        'country',
        'email',
        'phone',
    ];

    public function orderBilling(): HasOne
    {
        return $this->hasOne('Jskrd\Shop\Order', 'billing_address_id');
    }

    public function orderDelivery(): HasOne
    {
        return $this->hasOne('Jskrd\Shop\Order', 'delivery_address_id');
    }
}
