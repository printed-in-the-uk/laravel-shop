<?php

namespace Tests\Feature\Basket;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Jskrd\Shop\Basket;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function testRoute(): void
    {
        $id = Str::uuid();

        $this->assertSame(
            url('/shop-api/baskets/' . $id),
            route('baskets.destroy', $id)
        );
    }

    public function testNotFound(): void
    {
        $response = $this->deleteJson(route('baskets.destroy', Str::uuid()));

        $response->assertNotFound();
    }

    public function testDestroyed(): void
    {
        $basket = factory(Basket::class)->create();

        $response = $this->deleteJson(route('baskets.destroy', $basket));

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    'id' => $basket->id,
                    'subtotal' => $basket->subtotal,
                    'discount_amount' => $basket->discount_amount,
                    'delivery_cost' => $basket->delivery_cost,
                    'total' => $basket->total,
                    'billing_address_id' => $basket->billing_address_id,
                    'delivery_address_id' => $basket->delivery_address_id,
                    'discount_id' => $basket->discount_id,
                    'created_at' => $basket->created_at->toISOString(),
                    'updated_at' => $basket->updated_at->toISOString(),
                ],
            ]);

        $this->assertNull($basket->fresh());
    }
}
