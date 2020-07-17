<?php

namespace Jskrd\Shop\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Http\Controllers\Controller;
use Jskrd\Shop\Http\Requests\StoreBasketVariant;
use Jskrd\Shop\Http\Requests\UpdateBasketVariant;
use Jskrd\Shop\Http\Resources\BasketVariant as BasketVariantResource;
use Jskrd\Shop\Http\Resources\Variant as VariantResource;
use Jskrd\Shop\Variant;

class BasketVariantController extends Controller
{
    public function index(Basket $basket): JsonResource
    {
        return VariantResource::collection($basket->variants);
    }

    public function store(
        Basket $basket,
        StoreBasketVariant $request
    ): JsonResource {
        $validated = $request->validated();

        $variant = Variant::find($validated['variant_id']);

        $basket->variants()->attach($variant, array_merge($validated, [
            'price' => $variant->price,
        ]));

        return VariantResource::collection($basket->variants);
    }

    public function update(
        Basket $basket,
        Variant $variant,
        UpdateBasketVariant $request
    ): JsonResource {
        $validated = $request->validated();

        $basket->variants()->updateExistingPivot($variant, $validated);

        $basketVariant = $basket->variants()->find($variant->id)->pivot;

        return new BasketVariantResource($basketVariant);
    }

    public function destroy(Basket $basket, Variant $variant): JsonResource
    {
        $basket->variants()->detach($variant);

        return VariantResource::collection($basket->variants);
    }
}
