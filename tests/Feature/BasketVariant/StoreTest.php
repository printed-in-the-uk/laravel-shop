<?php

namespace Tests\Feature\BasketVariant;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Variant;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function testRoute(): void
    {
        $id = Str::uuid();

        $this->assertSame(
            url('/shop-api/baskets/' . $id . '/variants'),
            route('baskets.variants.store', $id)
        );
    }

    public function testNotFound(): void
    {
        $response = $this->postJson(
            route('baskets.variants.store', Str::uuid())
        );

        $response->assertNotFound();
    }

    public function testVariantIdRequired(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'variant_id' => '',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'variant_id' => 'The variant id field is required.'
            ]);
    }

    public function testVariantIdString(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'variant_id' => 12,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'variant_id' => 'The variant id must be a string.'
            ]);
    }

    public function testVariantIdUuid(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'variant_id' => '12',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'variant_id' => 'The variant id must be a valid UUID.'
            ]);
    }

    public function testVariantIdExists(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'variant_id' => Str::uuid(),
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'variant_id' => 'The selected variant id is invalid.'
            ]);
    }

    public function testCustomizationsRequired(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'customizations' => '',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'customizations' => 'The customizations field is required.'
            ]);
    }

    public function testCustomizationsString(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'customizations' => 123,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'customizations' => 'The customizations must be a string.'
            ]);
    }

    public function testCustomizationsJson(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'customizations' => 'name = Alice',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'customizations' => 'The customizations must be a valid JSON string.'
            ]);
    }

    public function testQuantityRequired(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'quantity' => '',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'quantity' => 'The quantity field is required.'
            ]);
    }

    public function testQuantityInteger(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'quantity' => 'one',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'quantity' => 'The quantity must be an integer.'
            ]);
    }

    public function testQuantityBetween(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'quantity' => 4294967296,
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'quantity' => 'The quantity must be between 1 and 4294967295.'
            ]);
    }

    public function testVariantAlreadyAttached(): void
    {
        $variant = factory(Variant::class)->create();

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'customizations' => '{}',
            'quantity' => 1,
            'price' => 0,
        ]);

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'variant_id' => $variant->id,
            'customizations' => '{}',
            'quantity' => 1,
        ]);

        $response->assertStatus(409);
    }

    public function testStored(): void
    {
        $basket = factory(Basket::class)->create();

        $variant = factory(Variant::class)->create(['price' => 7298]);

        $response = $this->postJson(route('baskets.variants.store', $basket), [
            'variant_id' => $variant->id,
            'customizations' => '{"name": "Alice"}',
            'quantity' => 2,
        ]);

        $pivot = $basket->variants[0]->pivot;

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    [
                        'id' => $variant->id,
                        'name' => $variant->name,
                        'slug' => $variant->slug,
                        'price' => $variant->price,
                        'delivery_cost' => $variant->delivery_cost,
                        'stock' => $variant->stock,
                        'option1' => $variant->option1,
                        'option2' => $variant->option2,
                        'option3' => $variant->option3,
                        'created_at' => $variant->created_at->toIso8601String(),
                        'updated_at' => $variant->updated_at->toIso8601String(),
                        'pivot' => [
                            'basket_id' => $pivot->basket_id,
                            'variant_id' => $pivot->variant_id,
                            'customizations' => '{"name": "Alice"}',
                            'quantity' => 2,
                            'price' => 7298,
                            'delivery_cost' => null,
                            'created_at' => $pivot->created_at->toIso8601String(),
                            'updated_at' => $pivot->updated_at->toIso8601String(),
                        ],
                    ],
                ],
            ]);
    }
}
