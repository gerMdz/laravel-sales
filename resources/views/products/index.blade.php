@extends('layouts.master')
@section('content')
    <h3>Lista de productos</h3>
    <a class="btn btn-success btn-sm" href="{{ route('products.create') }}"> Crear producto </a>
    @empty($products))
    <div class="alert alert-warning">
        <h2>
            Lista vacía
        </h2>
    </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th> Id</th>
                    <th> Title</th>
                    <th> Description</th>
                    <th> Price</th>
                    <th> Stock</th>
                    <th> Status</th>
                    <th><i class="bi bi-stack"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('products.show', ['product' => $product->id]) }}">
                                Ver
                            </a>
                            <a class="btn btn-warning" href="{{ route('products.edit', ['product' => $product->id]) }}">
                                Editar
                            </a>
                            <form method="POST"
                                  action="{{route('products.destroy', ['product' => $product->id])}}">
                                @csrf
                                @method('DELETE')


                                <button class="btn btn-danger" type="submit"> Borrar</button>

                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endempty
@endsection
