<?php

use Faker\Generator as Faker;
use Jskrd\Shop\Product;
use Jskrd\Shop\Variant;

$factory->define(Variant::class, function (Faker $faker) {
    return [
        'name' => ucwords($faker->words(rand(1, 3), true)),
        'price' => rand(100, 10000),
        'delivery_cost' => rand(100, 1000),
        'stock' => rand(0, 1) === 1 ? rand(1, 10) : null,
        'option1' => ucfirst($faker->word),
        'option2' => ucfirst($faker->word),
        'option3' => ucfirst($faker->word),
        'product_id' => factory(Product::class),
    ];
});
