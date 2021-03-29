<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.navbar-footer', function($view) {
            $view->with(['positions' => Cart::getCart()->products->count()]);
        });

        View::composer('layouts.navbar-footer', function($view) {
            $view->with(['positions' => Cart::getCount()]);
        });
    }
}
