<?php

namespace App\Providers;

use App\billing\paymentGateway;
use App\Observers\JobObserver;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        //singletone
        // $this->app->singleton(paymentGateway::class,function($app){
        //     return new paymentGateway('usd');
        // });
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
        if (Schema::hasTable('contacts')) {
            $lastMessages = DB::table("contacts")->latest("created_at")->take(3)->get();
            View::share('lastMessages', $lastMessages);
        }

        view()->composer('*', function ($view) {
            $lists = Cart::instance('main')->content();
            $view->with('lists', $lists);
        });
    }
}
