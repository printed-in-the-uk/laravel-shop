<?php

namespace Tests\Feature\BasketVariant;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Variant;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testRoute(): void
    {
        $id = Str::uuid();

        $this->assertSame(
            url('/shop-api/baskets/' . $id . '/variants'),
            route('baskets.variants.index', $id)
        );
    }

    public function testNotFound(): void
    {
        $response = $this->getJson(
            route('baskets.variants.index', Str::uuid())
        );

        $response->assertNotFound();
    }

    public function testIndexed(): void
    {
        $variant = factory(Variant::class)->create();

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'customizations' => ['name' => 'Alice'],
            'quantity' => 4,
            'price' => 2563,
            'delivery_cost' => null,
        ]);

        $response = $this->getJson(route('baskets.variants.index', $basket));

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
                        'product_id' => $variant->product_id,
                        'created_at' => $variant->created_at->toIso8601String(),
                        'updated_at' => $variant->updated_at->toIso8601String(),
                    ],
                ],
            ]);
    }
}
