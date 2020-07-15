<?php

namespace Jskrd\Shop;

use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrations();

        $this->publishes([
            __DIR__ . '/../database/factories/' => database_path('factories'),
        ]);
    }

    public function register()
    {
        //
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
