<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartCount = 0;

            if (auth()->check()) {
                $cart = auth()->user()->cart;
                if ($cart) {
                    $cartCount = $cart->items->sum('quantity');
                }
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
