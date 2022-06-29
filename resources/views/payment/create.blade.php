@extends('layouts.app')
@section('content')
    <h3>Detalle de la orden de pago</h3>
    <h4 class="text-center">
        <strong>Gran total: {{ $order->total }}</strong>
    </h4>
    <div class="text-center mb-3">
        <form class="d-inline" method="POST"
              action="{{route('orders.payments.store', ['order' => $order->id])}}">
            @csrf
            <button type="submit" class="btn btn-success">Pagar</button>

        </form>
    </div>




@endsection
