<?php

namespace Jskrd\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBasketVariant extends FormRequest
{
    public function rules()
    {
        return [
            'variant_id' => 'required|string|uuid|exists:variants,id',
            'customizations' => 'required|string|json',
            'quantity' => 'required|integer|between:1,4294967295',
        ];
    }
}
