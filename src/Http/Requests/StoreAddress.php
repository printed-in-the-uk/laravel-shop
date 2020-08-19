<?php

namespace Jskrd\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use League\ISO3166\ISO3166;

class StoreAddress extends FormRequest
{
    public function rules(): array
    {
        $countries = array_column((new ISO3166())->all(), 'alpha2');

        return [
            'name' => 'required|string|max:255',
            'street1' => 'required|string|max:255',
            'street2' => 'nullable|string|max:255',
            'locality' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'country' => 'required|string|size:2|in:' . implode(',', $countries),
            'email' => 'nullable|string|email|max:255',
            'phone' => 'nullable|string|max:255',
        ];
    }
}
