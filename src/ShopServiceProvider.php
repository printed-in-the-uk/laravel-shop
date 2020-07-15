<?php

namespace Jskrd\Shop;

use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrations();

        $this->publishes([
            __DIR__ . '/../database/factories/' => database_path('factories'),
        ]);
    }

    public function register(): void
    {
        //
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
