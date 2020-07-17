<?php

namespace Tests\Feature\BasketVariant;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Variant;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testRoute(): void
    {
        $basketId = Str::uuid();
        $variantId = Str::uuid();

        $this->assertSame(
            url('/shop-api/baskets/' . $basketId . '/variants/' . $variantId),
            route('baskets.variants.update', [$basketId, $variantId])
        );
    }

    public function testBasketNotFound(): void
    {
        $variant = factory(Variant::class)->create();

        $response = $this->putJson(
            route('baskets.variants.update', [Str::uuid(), $variant])
        );

        $response->assertNotFound();
    }

    public function testVariantNotFound(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->putJson(
            route('baskets.variants.update', [$basket, Str::uuid()])
        );

        $response->assertNotFound();
    }

    public function testCustomizationsRequired(): void
    {
        $variant = factory(Variant::class)->create();

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'customizations' => '{}',
            'quantity' => 0,
            'price' => 0,
        ]);

        $response = $this->putJson(
            route('baskets.variants.update', [$basket, $variant]),
            [
                'customizations' => '',
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'customizations' => 'The customizations field is required.'
            ]);
    }

    public function testCustomizationsString(): void
    {
        $variant = factory(Variant::class)->create();

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'customizations' => '{}',
            'quantity' => 0,
            'price' => 0,
        ]);

        $response = $this->putJson(
            route('baskets.variants.update', [$basket, $variant]),
            [
                'customizations' => 123,
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'customizations' => 'The customizations must be a string.'
            ]);
    }

    public function testCustomizationsJson(): void
    {
        $variant = factory(Variant::class)->create();

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'customizations' => '{}',
            'quantity' => 0,
            'price' => 0,
        ]);

        $response = $this->putJson(
            route('baskets.variants.update', [$basket, $variant]),
            [
                'customizations' => 'name = Alice',
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'customizations' => 'The customizations must be a valid JSON string.'
            ]);
    }

    public function testQuantityRequired(): void
    {
        $variant = factory(Variant::class)->create();

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'customizations' => '{}',
            'quantity' => 0,
            'price' => 0,
        ]);

        $response = $this->putJson(
            route('baskets.variants.update', [$basket, $variant]),
            [
                'quantity' => '',
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'quantity' => 'The quantity field is required.'
            ]);
    }

    public function testQuantityInteger(): void
    {
        $variant = factory(Variant::class)->create();

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'customizations' => '{}',
            'quantity' => 0,
            'price' => 0,
        ]);

        $response = $this->putJson(
            route('baskets.variants.update', [$basket, $variant]),
            [
                'quantity' => 'one',
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'quantity' => 'The quantity must be an integer.'
            ]);
    }

    public function testQuantityBetween(): void
    {
        $variant = factory(Variant::class)->create();

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'customizations' => '{}',
            'quantity' => 0,
            'price' => 0,
        ]);

        $response = $this->putJson(
            route('baskets.variants.update', [$basket, $variant]),
            [
                'quantity' => 4294967296,
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'quantity' => 'The quantity must be between 1 and 4294967295.'
            ]);
    }

    public function testUpdated(): void
    {
        $variant = factory(Variant::class)->create(['price' => 2182]);

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'customizations' => '{"name": "Alice"}',
            'quantity' => 9,
            'price' => 7298,
        ]);

        $response = $this->putJson(
            route('baskets.variants.update', [$basket, $variant]),
            [
                'customizations' => '{"name": "Bob"}',
                'quantity' => 5,
            ]
        );

        $pivot = $basket->variants[0]->pivot;

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    'basket_id' => $pivot->basket_id,
                    'variant_id' => $pivot->variant_id,
                    'customizations' => '{"name": "Bob"}',
                    'quantity' => 5,
                    'price' => 7298,
                    'delivery_cost' => null,
                    'created_at' => $pivot->created_at->toIso8601String(),
                    'updated_at' => $pivot->updated_at->toIso8601String(),
                ],
            ]);
    }
}
