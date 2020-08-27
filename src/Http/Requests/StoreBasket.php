<?php

namespace Jskrd\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBasket extends FormRequest
{
    public function rules()
    {
        return [
            'discount_id' => 'nullable|string|max:255|exists:discounts,id',
            'billing_address_id' => 'nullable|string|uuid|exists:addresses,id',
            'delivery_address_id' => 'nullable|string|uuid|exists:addresses,id',
        ];
    }
}
