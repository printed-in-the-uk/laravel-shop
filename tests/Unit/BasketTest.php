<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Order;
use Jskrd\Shop\Variant;
use Tests\TestCase;

class BasketTest extends TestCase
{
    use RefreshDatabase;

    public function testIdentifiable()
    {
        $uuidPattern = '/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89aAbB][a-f0-9]{3}-[a-f0-9]{12}$/';

        $basket = factory(Basket::class)->create();

        $this->assertRegExp($uuidPattern, $basket->id);
        $this->assertFalse($basket->incrementing);
    }

    public function testOrder()
    {
        $order = factory(Order::class)->make();

        $basket = factory(Basket::class)->create();
        $basket->order()->save($order);

        $this->assertSame($order->id, $basket->order->id);
    }

    public function testVariants()
    {
        $variant = factory(Variant::class)->create();

        $basket = factory(Basket::class)->create();
        $basket->variants()->attach($variant, [
            'quantity' => 7,
            'price' => 6813,
            'delivery_cost' => 457,
        ]);

        $this->assertSame($variant->id, $basket->variants[0]->id);
        $this->assertSame(7, $basket->variants[0]->pivot->quantity);
        $this->assertSame(6813, $basket->variants[0]->pivot->price);
        $this->assertSame(457, $basket->variants[0]->pivot->delivery_cost);
    }
}
