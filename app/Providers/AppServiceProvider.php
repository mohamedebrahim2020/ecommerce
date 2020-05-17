<?php

namespace App\Providers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
         Schema::defaultStringLength(191);
         if (Schema::hasTable('categories')) {
            $categories = DB::table('categories')->get();
            View::share('categories', $categories);
        }
       
        view()->composer('*', function ($view) 
    {   
        $lists = Cart::instance('main')->content();
        $view->with('lists', $lists );    
    });
    }
}
