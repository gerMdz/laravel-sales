<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    protected const COOKIE_NAME = 'cart';

    public function getFromCookieOrCreate()
    {
        $cartId = Cookie::get(self::COOKIE_NAME);
        $cart = Cart::find($cartId);
        return $cart ?? Cart::create();
    }

    public function makeCookie(Cart $cart)
    {
        return Cookie::make(self::COOKIE_NAME, $cart->id, 7 * 24 * 60);
    }
}
