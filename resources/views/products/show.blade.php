@extends('layouts.app')
@section('content')
    <h3>
        {{ $product->title }} <small>({{ $product->id  }})</small>
    </h3>
    <p>{{ $product->description }}</p>
    <p>   {{ $product->precio }} </p>
    <p>   {{ $product->stock }} </p>
    <p>   {{ $product->status }} </p>
@endsection

