<?php

namespace Tests\Feature\Basket;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Basket;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function testRoute(): void
    {
        $this->assertSame(url('/shop-api/baskets'), route('baskets.store'));
    }

    public function testStored(): void
    {
        $response = $this->postJson(route('baskets.store'));

        $basket = Basket::first();

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'data' => [
                    'id' => $basket->id,
                    'variants_count' => $basket->variants_count,
                    'subtotal' => $basket->subtotal,
                    'created_at' => $basket->created_at->toIso8601String(),
                    'updated_at' => $basket->updated_at->toIso8601String(),
                ],
            ]);
    }
}
