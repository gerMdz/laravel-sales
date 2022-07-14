<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        return DB::transaction(function () use ($request) {

            $user = $request->user();
            $order = $user->orders()->create([
                'status' => 'pending'
            ]);

            $cart = $this->cartService->getFromCookie();
            $cartProductsWithQuantity = $cart->products->mapWithKeys(function ($product) {

                $quantity = $product->pivot->quantity;
                if ($product->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'producto' => "No hay suficiente stock del producto {$product->title}"
                    ]);
                }

                $product->decrement('stock', $quantity);
                $element[$product->id] = ['quantity' => $quantity];

                return $element;
            });

            $order->products()->attach($cartProductsWithQuantity->toArray());

            return redirect()->route('orders.payments.create', ['order' => $order]);
        }, 5);

    }


}
