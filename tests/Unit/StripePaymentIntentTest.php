<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Order;
use Jskrd\Shop\StripePaymentIntent;
use Tests\TestCase;

class StripePaymentIntentTest extends TestCase
{
    use RefreshDatabase;

    public function testOrder(): void
    {
        $order = factory(Order::class)->make();

        $stripePaymentIntent = factory(StripePaymentIntent::class)->create();
        $stripePaymentIntent->order()->save($order);

        $this->assertSame(
            $order->id,
            $stripePaymentIntent->order->id
        );
    }
}
