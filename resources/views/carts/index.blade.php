@extends('layouts.app')
@section('content')
    <h1>Su carrito</h1>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">

        @if(!isset($cart) || $cart->products->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay productos en su carrito
            </div>
        @else
            <div class="row">
                @foreach($cart->products as $product)
                    <div class="col-3">
                        @include('components.product-card')
                    </div>
                @endforeach
            </div>
        @endempty


    </div>
@endsection
