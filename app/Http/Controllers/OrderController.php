<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function create()
    {
        $cart = $this->cartService->getFromCookie();
        if (!isset($cart) || $cart->products->isEmpty()) {
            return redirect()
                ->back()
                ->withErrors(("Tu carrito está vacío"));
        }
        return view('orders.create')->with([
            'cart' => $cart
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return RedirectResponse
     */
    public function store(StoreOrderRequest $request)
    {
        $user = $request->user();
        $order = $user->orders()->create([
            'status' => 'pending'
        ]);

        $cart = $this->cartService->getFromCookie();
        $cartProductsWithQuantity = $cart->products->mapWithKeys(function ($product) {
            $element[$product->id] = ['quantity' => $product->pivot->quantity];
            return $element;
        });
        $order->products()->attach($cartProductsWithQuantity->toArray());

        return redirect()->route('orders.payments.create', ['order' => $order]);

    }


}
