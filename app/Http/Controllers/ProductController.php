<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function store(ProductRequest $request): RedirectResponse
    {



        $product = Product::create($request->validated());
        session()->flash('success', "El nuevo producto {$product->title} con id {$product->id} fue creado");
        return redirect()
            ->route('products.index')
            ->withSuccess("El nuevo producto {$product->title} con id {$product->id} fue creado correctamente")
            ;
    }

    public function show(Product $product): string
    {
        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function edit(Product $product): string
    {
        return view('products.edit')->with([
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request, Product $product): string
    {

        $product->update($request->validated());
        return redirect()
            ->route('products.show', ['product' => $product])
            ->withSuccess("El nuevo producto {$product->title} con id {$product->id} fue actualizado correctamente")
            ;
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')
            ->withSuccess("El nuevo producto {$product->title} con id {$product->id} fue borrado correctamente")
            ;
    }
}
