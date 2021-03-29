<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('layouts.navbar-footer', function($view){
            //get all parent categories with their subcategories
            $categories = Category::where('parent_id', null)->with('children')->get();
            //attach the categories to the view.     
            $view->with(compact('categories'));
        });

      

        date_default_timezone_set('Europe/Riga');
    }
}
