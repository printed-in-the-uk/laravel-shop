<?php

namespace Tests\Feature\BasketVariant;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Variant;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testRoute(): void
    {
        $basketId = Str::uuid();
        $variantId = Str::uuid();

        $this->assertSame(
            url('/shop-api/baskets/' . $basketId . '/variants/' . $variantId),
            route('baskets.variants.show', [$basketId, $variantId])
        );
    }

    public function testBasketNotFound(): void
    {
        $variant = factory(Variant::class)->create();

        $response = $this->getJson(
            route('baskets.variants.show', [Str::uuid(), $variant])
        );

        $response->assertNotFound();
    }

    public function testVariantNotFound(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->getJson(
            route('baskets.variants.show', [$basket, Str::uuid()])
        );

        $response->assertNotFound();
    }

    public function testShown(): void
    {
        $variant = factory(Variant::class)->create(['price' => 2182]);

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'customizations' => '{"name": "Alice"}',
            'quantity' => rand(1, 10),
            'price' => rand(100, 10000),
        ]);

        $response = $this->getJson(
            route('baskets.variants.show', [$basket, $variant])
        );

        $pivot = $basket->variants[0]->pivot;

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    'basket_id' => $pivot->basket_id,
                    'variant_id' => $pivot->variant_id,
                    'customizations' => $pivot->customizations,
                    'quantity' => $pivot->quantity,
                    'price' => $pivot->price,
                    'delivery_cost' => $pivot->delivery_cost,
                    'created_at' => $pivot->created_at->toIso8601String(),
                    'updated_at' => $pivot->updated_at->toIso8601String(),
                ],
            ]);
    }
}
