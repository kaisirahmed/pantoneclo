<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Cart;

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
        View::composer('*', function ($view) {

            $cartTotal = number_format(Cart::getTotal(),2);
            $cartTotalQuantity = Cart::getTotalQuantity();

            // $categoryId = Category::pluck('parent_id');
            // $categories = Category::select('id','name','slug','image')->whereNotIn('id',$categoryId)->get();
            $categories = Category::all();
            $view->with('categories', $categories);
            $view->with('cartTotal', $cartTotal);
            $view->with('cartTotalQuantity', $cartTotalQuantity);
          });    
        //View::share('categories',compact('categories'));
    }
}
