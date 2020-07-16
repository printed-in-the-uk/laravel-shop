<?php

namespace Jskrd\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBasketVariant extends FormRequest
{
    public function rules()
    {
        return [
            'customizations' => 'required|string|json',
            'quantity' => 'required|integer|between:1,4294967295',
        ];
    }
}
