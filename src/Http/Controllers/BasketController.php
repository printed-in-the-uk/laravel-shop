<?php

namespace Jskrd\Shop\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Http\Controllers\Controller;
use Jskrd\Shop\Http\Requests\StoreBasket;
use Jskrd\Shop\Http\Requests\UpdateBasket;
use Jskrd\Shop\Http\Resources\Basket as BasketResource;

class BasketController extends Controller
{
    public function store(StoreBasket $request): JsonResource
    {
        $validated = $request->validated();

        $basket = Basket::create($validated);

        return new BasketResource($basket);
    }

    public function show(Basket $basket): JsonResource
    {
        return new BasketResource($basket);
    }

    public function update(Basket $basket, UpdateBasket $request): JsonResource
    {
        $validated = $request->validated();

        $basket->update($validated);

        return new BasketResource($basket);
    }

    public function destroy(Basket $basket): JsonResource
    {
        $basket->delete();

        return new BasketResource($basket);
    }
}
