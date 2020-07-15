<?php

use Faker\Generator as Faker;
use Jskrd\Shop\Order;
use Jskrd\Shop\StripePaymentIntent;
use Jskrd\Shop\Transaction;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'amount' => rand(100, 10000),
        'order_id' => factory(Order::class),
        'transactionable_id' => factory(StripePaymentIntent::class),
        'transactionable_type' => 'Jskrd\Shop\StripePaymentIntent',
    ];
});
