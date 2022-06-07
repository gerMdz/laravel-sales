<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    protected const COOKIE_NAME = 'cart';

    public function getFromCookie()
    {
        $cartId = Cookie::get(self::COOKIE_NAME);
        return Cart::find($cartId);
    }

    public function getFromCookieOrCreate()
    {
        $cart = $this->getFromCookie();
        return $cart ?? Cart::create();
    }

    public function makeCookie(Cart $cart)
    {
        return Cookie::make(self::COOKIE_NAME, $cart->id, 7 * 24 * 60);
    }

    public function countProducts(): int
    {
        $cart = $this->getFromCookie();
        if ($cart != null) {
            return $cart->products->pluck('pivot.quantity')->sum();
        }
        return 0;
    }

}
