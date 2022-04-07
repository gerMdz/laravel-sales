@extends('layouts.master')
@section('content')
    <h3>
        Editar un producto
    </h3>
    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
            <label for="title">Title
                <input type="text" id="title" name="title" class="form-control" value="{{ $product->title }}" required>
            </label>
            <label for="description">Description
                <input type="text" id="description" name="description" class="form-control" value="{{ $product->description }}" required>
            </label>
            <label for="price">Precio
                <input type="number" name="price" id="price" min="1.00" step="0.01" class="form-control" value="{{ $product->price }}" required>
            </label>
            <label for="stock">Stock
                <input type="number" name="stock" min="0" id="stock" class="form-control" value="{{ $product->stock }}" required>
            </label>
            <label for="status">Status</label>
                <select name="status" id="status" class="custom-select">
                <option {{ $product->status == 'available' ? 'selected': '' }} value="available">Available</option>
                <option {{ $product->status == 'unavailable' ? 'selected': '' }} value="unavailable">Unavailable</option>
                </select>

        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary btn-lg"> Editar producto</button>
        </div>

    </form>
@endsection
