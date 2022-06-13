<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;


class ProductCartController extends Controller
{

    private $cartService;

    /**
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function store(Request $request, Product $product)
    {
        $cart = $this->cartService->getFromCookieOrCreate();

        $quantity = $cart->products()
                ->find($product->id)
                ->pivot
                ->quantity ?? 0;
        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $quantity + 1]
        ]);

        $cookie = $this->cartService->makeCookie($cart);



        return redirect()->back()->cookie($cookie);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @param Cart $cart
     * @return RedirectResponse
     */
    public function destroy(Product $product, Cart $cart)
    {
        $cart->products()->detach($product->id);

        $cookie =$this->cartService->makeCookie($cart);

        return redirect()->back()->cookie($cookie);
    }


}
