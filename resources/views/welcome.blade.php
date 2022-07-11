@extends('layouts.app')
@section('content')
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        @empty($products)
            <div class="alert alert-danger" role="alert">
                No hay productos
            </div>
        @else
            <div class="row">
                @foreach($products as $product)
                    <div class="col-3">
                        @include('components.product-card')
                    </div>
                @endforeach
            </div>

        @endempty

        <h1>Bienvenidos</h1>

        <div class="row">

        </div>
    </div>
@endsection
