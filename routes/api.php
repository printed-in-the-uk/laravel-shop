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

        Route::apiResource('products', 'ProductController')
            ->only(['index', 'show']);

        Route::apiResource('products.images', 'ProductImageController')
            ->only(['index']);

        Route::apiResource('variants', 'VariantController')
            ->only(['show']);
    });
