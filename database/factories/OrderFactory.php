<?php

use Faker\Generator as Faker;
use Jskrd\Shop\Address;
use Jskrd\Shop\Basket;
use Jskrd\Shop\Order;
use Jskrd\Shop\StripePaymentIntent;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'basket_id' => factory(Basket::class),
        'billing_address_id' => factory(Address::class),
        'delivery_address_id' => factory(Address::class),
        'paymentable_id' => factory(StripePaymentIntent::class),
        'paymentable_type' => 'Jskrd\Shop\StripePaymentIntent',
    ];
});
