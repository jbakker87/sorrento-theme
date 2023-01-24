<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Roots\Acorn\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
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
        // "illuminate/routing": "^8.0",
        // dd('hoi');
        // Route::any('', function($slug){
        //     dd('hoi');
        // });
        Route::get('/product/pizza-pollo/', function($slug){
            dd('hoi');
        });
    }
}
