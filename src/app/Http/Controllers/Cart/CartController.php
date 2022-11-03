<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CartController extends Controller
{
    public function show(Cart $cart): View
    {
        $carts = Cart::with(['product', 'user'])
            ->orderBy('user_id')
            ->get();

        return view('cart.index', ['carts' => $carts]);
    }

    public function customerCart(User $user): View
    {
        $cart = Cart::with('user')
            ->where('user_id', $user->id)
            ->get();

        /*
         * alternative syntax for returning the view with `view data`
         * https://laravel.com/docs/9.x/views#creating-and-rendering-views
         * https://laravel.com/docs/9.x/views#passing-data-to-views
         */
        return ViewFacade::make('cart.customer')
            ->with('cart', $cart,)
            ->with('user', $user);
    }
}
