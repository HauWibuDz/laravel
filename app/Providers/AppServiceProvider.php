<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Helper\Cart;

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
       Paginator::useBootstrapFive();
        
       view()->composer('master',function($view){
        $cats = Category::get();
        $cart = new Cart();
        $view->with(compact('cats','cart'));
       });


       
    //    View::share('cart',$cart);
    }

    
}
