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
            'products' => $products = Product::all(),
        ]);
    }

    public function create(): string
    {
        return view('products.create');
    }

    public function store()
    {

//        $product = Product::create([
//            'id'=> Str::uuid()->toString(),
//            'title' => request()->title,
//            'description' => request()->description,
//            'price' => request()->price,
//            'stock' => request()->stock,
//            'status' => request()->status,
//        ]);
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
        return "Un form para editar el producto $product From CONTROLLER";
    }

    public function update($product): string
    {
        return "Un form para updater el producto $product From CONTROLLER";
    }

    public function destroy($product): string
    {
        return "Un form para destroyer el producto $product From CONTROLLER";
    }
}
