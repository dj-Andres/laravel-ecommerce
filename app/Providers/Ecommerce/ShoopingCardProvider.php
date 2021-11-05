<?php

namespace App\Providers\Ecommerce;

use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class ShoopingCardProvider extends ServiceProvider
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
        view()->composer("*", function ($view) {
            $sessionName = 'shopping_card_id';
            $shoppingCartId = Session::get($sessionName);
            $shoppingCart = ShoppingCart::findOrCreateBySession($shoppingCartId);
            Session::put($sessionName, $shoppingCart->id);

            $view->with('shoppingCard', $shoppingCart);
        });
    }
}
