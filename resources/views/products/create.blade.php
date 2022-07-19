@extends('layouts.app')
@section('content')
    <h3>
        Crear un producto
    </h3>
    <form action="{{  route('products.store')  }}" method="POST"
          enctype="multipart/form-data"
    >
        @csrf
        <div class="form-row">
            <label for="title">Title
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
            </label>
        </div>
        <div class="form-row">
            <label for="description">Description
                <input type="text" id="description" name="description" class="form-control"
                       value="{{ old('description') }}" required>
            </label>
        </div>
        <div class="form-row">
            <label for="price">Precio
                <input type="number" name="price" id="price" min="1.00" step="0.01" class="form-control"
                       value="{{ old('price') }}" required>
            </label>
        </div>
        <div class="form-row">
            <label for="stock">Stock
                <input type="number" name="stock" min="0" id="stock" class="form-control" value="{{ old('stock') }}"
                       required>
            </label>
        </div>
        <div class="form-row">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control custom-select" required>
                <option value="" selected>Select ...</option>
                <option {{ old('status') == 'available' ? 'selected': '' }} value="available">Available</option>
                <option {{ old('status') == 'unavailable' ? 'selected': '' }} value="unavailable">Unavailable</option>
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

        </div>
        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary btn-lg"> Crear producto</button>
        </div>

    </form>
    {{--    <p>{{ $product->description }}</p>--}}
    {{--    <p>   {{ $product->precio }} </p>--}}
    {{--    <p>   {{ $product->stock }} </p>--}}
    {{--    <p>   {{ $product->status }} </p>--}}
@endsection

