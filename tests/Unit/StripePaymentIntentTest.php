<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\StripePaymentIntent;
use Jskrd\Shop\Transaction;
use Tests\TestCase;

class StripePaymentIntentTest extends TestCase
{
    use RefreshDatabase;

    public function testTransaction(): void
    {
        $transaction = factory(Transaction::class)->make();

        $stripePaymentIntent = factory(StripePaymentIntent::class)->create();
        $stripePaymentIntent->transaction()->save($transaction);

        $this->assertSame(
            $transaction->id,
            $stripePaymentIntent->transaction->id
        );
    }
}
