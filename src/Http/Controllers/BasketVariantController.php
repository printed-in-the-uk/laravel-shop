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

        abort_if(
            $basket->variants->contains(function ($variant) use ($validated) {
                $pivot = $variant->pivot;

                return $pivot->variant_id === $validated['variant_id'] &&
                    $pivot->customizations === $validated['customizations'];
            }),
            409
        );

        $variant = Variant::find($validated['variant_id']);

        $basket->variants()->attach($variant, array_merge($validated, [
            'price' => $variant->price,
        ]));

        return new BasketVariantResource(
            $basket->variants()->find($variant)->pivot
        );
    }

    public function show(Basket $basket, Variant $variant): JsonResource
    {
        $basketVariant = $basket->variants()->find($variant)->pivot;

        return new BasketVariantResource($basketVariant);
    }

    public function update(
        Basket $basket,
        Variant $variant,
        UpdateBasketVariant $request
    ): JsonResource {
        $validated = $request->validated();

        abort_unless($basket->variants->contains($variant), 404);

        $basket->variants()->updateExistingPivot($variant, $validated);

        return new BasketVariantResource(
            $basket->variants()->find($variant)->pivot
        );
    }

    public function destroy(Basket $basket, Variant $variant): JsonResource
    {
        $basket->variants()->detach($variant);

        return VariantResource::collection($basket->variants);
    }
}
