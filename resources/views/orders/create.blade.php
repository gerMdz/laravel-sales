@extends('layouts.app')
@section('content')
    <h3>Lista de productos</h3>
    <h4 class="text-center">
        <strong>Gran total: {{ $cart->total }}</strong>
    </h4>
    <div class="text-center mb-3">
        <form class="d-inline" method="POST"
              action="{{route('orders.store')}}">
            @csrf
            <button type="submit" class="btn btn-success">Confirmar Orden</button>

        </form>
    </div>


    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th> Producto</th>
                <th> Precio</th>
                <th> Cantidad</th>
                <th> Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart->products as $product)
                <tr>
                    <td>
                        <img src="{{asset($product->images->first()->path)}}" width="100px"/>
                        {{ $product->title }}
                    </td>

                    <td>{{ $product->price }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>
                        <strong>
                            $ {{ $product->total }}
                        </strong>
                    </td>
                    {{--                    <td>--}}
                    {{--                        <a class="btn btn-info" href="{{ route('products.show', ['product' => $product->id]) }}">--}}
                    {{--                            Ver--}}
                    {{--                        </a>--}}
                    {{--                        <a class="btn btn-warning" href="{{ route('products.edit', ['product' => $product->id]) }}">--}}
                    {{--                            Editar--}}
                    {{--                        </a>--}}
                    {{--                        <form method="POST" class="d-inline"--}}
                    {{--                              action="{{route('products.destroy', ['product' => $product->id])}}">--}}
                    {{--                            @csrf--}}
                    {{--                            @method('DELETE')--}}
                    {{--                            <button class="btn btn-danger" type="submit"> Borrar</button>--}}
                    {{--                        </form>--}}
                    {{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th> $ {{$cart->total}}</th>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
