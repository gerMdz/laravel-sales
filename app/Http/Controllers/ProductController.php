<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return 'Este es el form para crear productos from CONTROLLER';
    }

    public function store()
    {

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
        return "Un form para editar el producto $product From CONTROLLER" ;
    }

    public function update($product): string
    {
        return "Un form para updater el producto $product From CONTROLLER" ;
    }

    public function destroy($product): string
    {
        return "Un form para destroyer el producto $product From CONTROLLER" ;
    }
}
