<?php

namespace App\Http\Controllers;

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

    public function store(): RedirectResponse
    {
        $rules = [
          'title' => ['required','max:255'],
          'description' => ['required','max:1000'],
          'price' => ['required','min:1'],
          'stock' => ['required','min:0'],
          'status' => ['required','in:available,unavailable'],
        ];

        request()->validate($rules);

        if (request()->status == 'available' && request()->stock == 0) {
            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors('If available must hace stock')
                ;
        }

        $product = Product::create(request()->all());
        session()->flash('success', "El nuevo producto {$product->title} con id {$product->id} fue creado");
        return redirect()
            ->route('products.index')
            ->withSuccess("El nuevo producto {$product->title} con id {$product->id} fue creado correctamente")
            ;
    }

    public function show($product): string
    {
        $product = Product::findOrFail($product);

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
        $rules = [
            'title' => ['required','max:255'],
            'description' => ['required','max:1000'],
            'price' => ['required','min:1'],
            'stock' => ['required','min:0'],
            'status' => ['required','in:available, unavailable'],
        ];
        request()->validate($rules);

        $product = Product::findOrFail($product);

        $product->update(request()->all());
        return redirect()
            ->route('products.show', ['product' => $product])
            ->withSuccess("El nuevo producto {$product->title} con id {$product->id} fue actualizado correctamente")
            ;
    }

    public function destroy($product): RedirectResponse
    {
        $product = Product::findOrFail($product);
        $product->delete();
        return redirect()->route('products.index')
            ->withSuccess("El nuevo producto {$product->title} con id {$product->id} fue borrado correctamente")
            ;
    }
}
