<?php

namespace Jskrd\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddress extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'street1' => 'required|string|max:255',
            'street2' => 'nullable|string|max:255',
            'locality' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'country' => 'required|string|size:2',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'nullable|string|max:255',
        ];
    }
}
