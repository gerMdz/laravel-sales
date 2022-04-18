@extends('layouts.master')
@section('content')
    <h3>
        Crear un producto
    </h3>
    <form action="{{  route('products.store')  }}" method="POST">
        @csrf
        <div class="form-row">
            <label for="title">Title
                <input type="text" id="title" name="title" class="form-control"  value="{{ old('title') }}" required>
            </label>
            <label for="description">Description
                <input type="text" id="description" name="description" class="form-control"  value="{{ old('description') }}" required>
            </label>
            <label for="price">Precio
                <input type="number" name="price" id="price" min="1.00" step="0.01" class="form-control"  value="{{ old('price') }}" required>
            </label>
            <label for="stock">Stock
                <input type="number" name="stock" min="0" id="stock" class="form-control"  value="{{ old('stock') }}" required>
            </label>
            <label for="status">Status</label>
                <select name="status" id="status" class="custom-select" required>
                <option value="" selected>Select ...</option>
                <option {{ old('status') == 'available' ? 'selected': '' }} value="available">Available</option>
                <option {{ old('status') == 'unavailable' ? 'selected': '' }} value="unavailable">Unavailable</option>
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

