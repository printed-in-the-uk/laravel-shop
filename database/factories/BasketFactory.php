<?php

use Faker\Generator as Faker;
use Jskrd\Shop\Address;
use Jskrd\Shop\Basket;

$factory->define(Basket::class, function (Faker $faker) {
    return [
        'billing_address_id' => factory(Address::class),
        'delivery_address_id' => factory(Address::class),
    ];
});
