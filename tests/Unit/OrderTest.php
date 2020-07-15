<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Address;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Order;
use Jskrd\Shop\Transaction;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function testIdentifiable()
    {
        $uuidPattern = '/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89aAbB][a-f0-9]{3}-[a-f0-9]{12}$/';

        $order = factory(Order::class)->create();

        $this->assertRegExp($uuidPattern, $order->id);
        $this->assertFalse($order->incrementing);
    }

    public function testBasket()
    {
        $basket = factory(Basket::class)->create();

        $order = factory(Order::class)->create();
        $order->basket()->associate($basket);

        $this->assertSame($basket->id, $order->basket->id);
    }

    public function testBillingAddress()
    {
        $billingAddress = factory(Address::class)->create();

        $order = factory(Order::class)->create();
        $order->billingAddress()->associate($billingAddress);

        $this->assertSame($billingAddress->id, $order->billingAddress->id);
    }

    public function testDeliveryAddress()
    {
        $deliveryAddress = factory(Address::class)->create();

        $order = factory(Order::class)->create();
        $order->deliveryAddress()->associate($deliveryAddress);

        $this->assertSame($deliveryAddress->id, $order->deliveryAddress->id);
    }

    public function testTransactions()
    {
        $transaction = factory(Transaction::class)->make();

        $order = factory(Order::class)->create();
        $order->transactions()->save($transaction);

        $this->assertSame($transaction->id, $order->transactions[0]->id);
    }
}
