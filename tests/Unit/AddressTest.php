<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Address;
use Jskrd\Shop\Order;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function testIdentifiable()
    {
        $uuidPattern = '/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89aAbB][a-f0-9]{3}-[a-f0-9]{12}$/';

        $address = factory(Address::class)->create();

        $this->assertRegExp($uuidPattern, $address->id);
        $this->assertFalse($address->incrementing);
    }

    public function testOrderBilling()
    {
        $order = factory(Order::class)->make();

        $address = factory(Address::class)->create();
        $address->orderBilling()->save($order);

        $this->assertSame($order->id, $address->orderBilling->id);
    }

    public function testOrderDelivery()
    {
        $order = factory(Order::class)->make();

        $address = factory(Address::class)->create();
        $address->orderDelivery()->save($order);

        $this->assertSame($order->id, $address->orderDelivery->id);
    }
}
