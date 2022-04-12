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
          'status' => ['required','in:available, unavailable'],
        ];
        request()->validate($rules);

        if (request()->status == 'available' && request()->stock == 0) {
            session()->flash('error', 'If available must hace stock');
            return redirect()->back();
        }

        $product = Product::create(request()->all());
        return redirect()->route('products.index');
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
        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function destroy($product): RedirectResponse
    {
        $product = Product::findOrFail($product);
        $product->delete();
        return redirect()->route('products.index');
    }
}
