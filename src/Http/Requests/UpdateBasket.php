<?php

namespace Jskrd\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Jskrd\Shop\Http\Requests\StoreBasket;

class UpdateBasket extends FormRequest
{
    public function rules(): array
    {
        return (new StoreBasket())->rules();
    }
}
