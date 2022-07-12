<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Services\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderPaymentController extends Controller
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
     * @param Order $order
     * @return Application|Factory|View
     */
    public function create(Order $order)
    {
        return view('payment.create')->with([
            'order' => $order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function store(Request $request, Order $order): Response
    {
        //PaymentService::handlePayment()
        return DB::transaction(function () use ($order) {

            $this->cartService->getFromCookie()->products()->detach();
            $order->payment()->create([
                'amount' => $order->total,
                'payed_at' => now(),
            ]);
            $order->status = 'payed';
            $order->save();

            return redirect()
                ->route('main')
                ->withSuccess("Hemos recibido tu pago por \${$order->total}");

        }, 5);
    }

}
