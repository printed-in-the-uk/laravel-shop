<?php

namespace Jskrd\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Jskrd\Shop\Http\Requests\StoreAddress;

class UpdateAddress extends FormRequest
{
    public function rules(): array
    {
        return (new StoreAddress())->rules();
    }
}
