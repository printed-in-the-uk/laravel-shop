<?php

Route::middleware('api')
    ->namespace('Jskrd\Shop\Http\Controllers')
    ->prefix('shop-api')
    ->group(function () {
        Route::apiResource('baskets', 'BasketController')
            ->only(['store', 'show']);
    });
