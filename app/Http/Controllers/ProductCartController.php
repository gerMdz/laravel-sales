<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductCartController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function store(Request $request, Product $product)
    {
        $cart = Cart::create();
        $quantity = $cart->products()
            ->find($product->id)
            ->pivot
            ->quntity ?? 0;
        $cart->products()->attach([
           $product->id => ['quantity' => $quantity + 1]
        ]);

        return redirect()->back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @param Cart $cart
     * @return Response
     */
    public function destroy(Product $product, Cart $cart)
    {
        //
    }
}
