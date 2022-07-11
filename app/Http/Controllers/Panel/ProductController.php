<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\PanelProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{

    public function index(): string
    {
        return view('products.index')->with([
            'products' => PanelProduct::without('images')->get()
        ]);
    }

    public function create(): string
    {
        return view('products.create');
    }

    public function store(ProductRequest $request): RedirectResponse
    {

        $product = PanelProduct::create($request->validated());
        session()->flash('success', "El nuevo producto {$product->title} con id {$product->id} fue creado");
        return redirect()
            ->route('products.index')
            ->withSuccess("El nuevo producto {$product->title} con id {$product->id} fue creado correctamente")
            ;
    }

    public function show(PanelProduct $product): string
    {
        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function edit(PanelProduct $product): string
    {
        return view('products.edit')->with([
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request, PanelProduct $product): string
    {

        $product->update($request->validated());
        return redirect()
            ->route('products.show', ['product' => $product])
            ->withSuccess("El nuevo producto {$product->title} con id {$product->id} fue actualizado correctamente")
            ;
    }

    public function destroy(PanelProduct $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')
            ->withSuccess("El nuevo producto {$product->title} con id {$product->id} fue borrado correctamente")
            ;
    }
}
