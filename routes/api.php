<?php

Route::middleware('api')
    ->namespace('Jskrd\Shop\Http\Controllers')
    ->prefix('shop-api')
    ->group(function () {
        Route::apiResource('addresses', 'AddressController')
            ->only(['store']);

        Route::apiResource('baskets', 'BasketController')
            ->only(['store', 'show']);

        Route::apiResource('baskets.variants', 'BasketVariantController');
    });
