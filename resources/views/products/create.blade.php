@extends('layouts.master')
@section('content')
    <h3>
        Crear un producto
    </h3>
    <form action="{{  route('products.store')  }}" method="POST">
        @csrf
        <div class="form-row">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control" required>
            <label for="price">Precio</label>
            <input type="number" name="price" min="1.00" step="0.01" class="form-control" required>
            <label for="stock">Stock</label>
            <input type="number" name="stock" min="0" class="form-control" required>
            <label for="status">Status</label>
            <select name="status" id="" class="custom-select">
                <option value="" selected>Select ...</option>
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
            </select>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary btn-lg"> Crear producto</button>
        </div>

    </form>
{{--    <p>{{ $product->description }}</p>--}}
{{--    <p>   {{ $product->precio }} </p>--}}
{{--    <p>   {{ $product->stock }} </p>--}}
{{--    <p>   {{ $product->status }} </p>--}}
@endsection

