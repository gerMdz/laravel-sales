<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(): string
    {
        return view('products.index')->with([
            'products' => Product::all(),
        ]);
    }

    public function create(): string
    {
        return view('products.create');
    }

    public function store()
    {
        return Product::create(request()->all());
    }

    public function show($product): string
    {
        $product = Product::findOrFail($product);
//        $product = DB::table('products')->where('id', $product)->first();
//        $product = DB::table('products')->find($product);
//        dd($product);

        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function edit($product): string
    {

        return view('products.edit')->with([
           'product' => Product::findOrFail($product)
        ]);
    }

    public function update($product): string
    {
        $product = Product::findOrFail($product);

        $product->update(request()->all());
        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function destroy($product)
    {
        $product = Product::findOrFail($product);
        $product->delete();
        return $product;
    }
}
