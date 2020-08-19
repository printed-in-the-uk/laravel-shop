<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Jskrd\Shop\Discount;
use Jskrd\Shop\Variant;

$factory->define(Discount::class, function (Faker $faker) {
    return [
        'id' => Str::random(10),
        'name' => $faker->name,
        'percent' => rand(10, 100),
        'maximum' => rand(0, 1) === 1 ? rand(1, 10) * 100 : null,
        'limit' => rand(0, 1) === 1 ? rand(1, 10000) : null,
        'variant_id' => rand(0, 1) === 1 ? factory(Variant::class) : null,
    ];
});
