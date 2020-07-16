<?php

namespace Tests\Feature\Basket;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Jskrd\Shop\Basket;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testRoute(): void
    {
        $this->assertSame(url('/shop-api/baskets'), route('baskets.store'));
    }

    public function testNotFound(): void
    {
        $response = $this->getJson(route('baskets.show', Str::uuid()));

        $response->assertNotFound();
    }

    public function testShown(): void
    {
        $basket = factory(Basket::class)->create();
        $basket->refresh();

        $response = $this->getJson(route('baskets.show', $basket));

        $response
            ->assertStatus(200)
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
