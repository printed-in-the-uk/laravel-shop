<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jskrd\Shop\PaypalPayment;
use Jskrd\Shop\Transaction;
use Tests\TestCase;

class PaypalPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function testTransaction()
    {
        $transaction = factory(Transaction::class)->make();

        $paypalPayment = factory(PaypalPayment::class)->create();
        $paypalPayment->transaction()->save($transaction);

        $this->assertSame($transaction->id, $paypalPayment->transaction->id);
    }
}
