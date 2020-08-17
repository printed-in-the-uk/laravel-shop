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
                    'delivery_cost' => $basket->delivery_cost,
                    'discount_amount' => $basket->discount_amount,
                    'delivery_address_id' => $basket->delivery_address_id,
                    'billing_address_id' => $basket->billing_address_id,
                    'discount_id' => $basket->discount_id,
                    'created_at' => $basket->created_at->toIso8601String(),
                    'updated_at' => $basket->updated_at->toIso8601String(),
                ],
            ]);
    }
}
