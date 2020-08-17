<?php

use Faker\Generator as Faker;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Order;
use Jskrd\Shop\StripePaymentIntent;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'basket_id' => factory(Basket::class),
        'paymentable_id' => factory(StripePaymentIntent::class),
        'paymentable_type' => 'Jskrd\Shop\StripePaymentIntent',
    ];
});
