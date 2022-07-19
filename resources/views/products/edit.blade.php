@extends('layouts.app')
@section('content')
    <h3>
        Editar un producto
    </h3>
    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST"
          enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')
        <div class="form-row">
            <label for="title">Title
                <input type="text" id="title" name="title" class="form-control"
                       value="{{ old('title') ?? $product->title }}" required>
            </label>
            <label for="description">Description
                <input type="text" id="description" name="description" class="form-control"
                       value="{{ old('description') ??$product->description }}" required>
            </label>
            <label for="price">Precio
                <input type="number" name="price" id="price" min="1.00" step="0.01" class="form-control"
                       value="{{ old('price') ?? $product->price }}" required>
            </label>
            <label for="stock">Stock
                <input type="number" name="stock" min="0" id="stock" class="form-control"
                       value="{{old('stock') ?? $product->stock }}" required>
            </label>
            <label for="status">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option
                    {{ old('status') == 'available' ? 'selected': ($product->status == 'available' ? 'selected': '') }} value="available">
                    Available
                </option>
                <option
                    {{ old('status') == 'unavailable' ? 'selected': ($product->status == 'unavailable' ? 'selected': '') }} value="unavailable">
                    Unavailable
                </option>
            </select>

        </div>
        <div class="form-row">
            <label class="col-md-4 col-form-label text-md-end">
                {{ __('Imagen') }}
            </label>

            <div class="col-md-6">
                <div class="custom-file">
                    <input type="file" accept="image/*" name="images[]"
                           class="form-control custom-file-input" multiple
                           id="image"
                    >
                    <label for="image" class="form-label custom-file-label">
                        Imágenes de producto
                    </label>
                </div>
            </div>


        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary btn-lg "> Editar producto</button>
        </div>

    </form>
@endsection
