<?php

use Faker\Generator as Faker;
use Jskrd\Shop\Country;
use Jskrd\Shop\Zone;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'alpha2' => $faker->countryCode,
        'zone_id' => factory(Zone::class),
    ];
});
