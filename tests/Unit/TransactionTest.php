<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\Order;
use Jskrd\Shop\StripePaymentIntent;
use Jskrd\Shop\Transaction;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function testIdentifiable()
    {
        $uuidPattern = '/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89aAbB][a-f0-9]{3}-[a-f0-9]{12}$/';

        $transaction = factory(Transaction::class)->create();

        $this->assertRegExp($uuidPattern, $transaction->id);
        $this->assertFalse($transaction->incrementing);
    }

    public function testOrder()
    {
        $order = factory(Order::class)->create();

        $transaction = factory(Transaction::class)->create();
        $transaction->order()->associate($order);

        $this->assertSame($order->id, $transaction->order->id);
    }

    public function testTransactionable()
    {
        $stripePaymentIntent = factory(StripePaymentIntent::class)->create();

        $transaction = factory(Transaction::class)->create();
        $transaction->transactionable()->associate($stripePaymentIntent);

        $this->assertSame(
            $stripePaymentIntent->id,
            $transaction->transactionable->id
        );
    }
}
